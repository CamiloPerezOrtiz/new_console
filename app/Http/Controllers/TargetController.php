<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Campus;
use Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class TargetController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function showGroupsTarget()
    {
        $role= \Auth::user()->role;
        if($role === 'SUPER'){
            $group=Group::orderBy('id')->paginate();
            return view('target.showGroups',compact('group'));
        }
        if($role === 'ADMIN'){
            $group_id= \Auth::user()->group_id;
            return redirect()->route('showDevicesTarget', $group_id);
        }
    }

    public function showDevicesTarget($id)
    {
    	$device = DB::table('campuses')->select('id','name','group_id')->distinct()->where('group_id', '=', $id)->get();
    	return view('target.showDevices',compact('device','id'));
    }

    public function showTargetDevice($id, $name)
    {
    	$name_group = $this->name_group($id);
    	$campus = $name;
    	$xml = simplexml_load_file("clients/$name_group/$campus/info_squidguarddest.xml");
    	$target_xml= $xml->config;
    	return view('target.showTargetDevice',compact('target_xml','id','campus'));
    }

    public function createTargetDevice($id)
    {
    	$device = DB::table('campuses')->select('id','name')->distinct()->where('group_id', '=', $id)->get();
    	return view('target.createTargetDevice',compact('id','device'));
    }

    public function createTargetDevicePost(Request $request, $id)
    {
    	$this->validate($request,[ 
            'name' => 'required',
            'domain_list' => 'required',
            'url_list' => 'required',
            'expression_regular' => 'required',
        ]);
    	$name_group = $this->name_group($id);
    	$campuses = $request->campus;
    	foreach($campuses as $campus){
			$xml = simplexml_load_file("clients/$name_group/$campus/info_squidguarddest.xml");
			foreach($xml->config as $config){
				if($config->name == $request->name)
					return Redirect::back()->withInput(Input::all())->with('danger',"The name that you try to register already exists in $campus");
			}
			$contenido = "\t\t<squidguarddest>\n";
				foreach($xml->config as $config){
				    $contenido .= "\t\t\t<config>\n";
					    $contenido .= "\t\t\t\t<name>" . $config->name . "</name>\n";
					    $contenido .= "\t\t\t\t<domains>" . $config->domains . "</domains>\n";
					    $contenido .= "\t\t\t\t<urls>" . $config->urls . "</urls>\n";
					    $contenido .= "\t\t\t\t<expressions>" . $config->expressions . "</expressions>\n";
					    $contenido .= "\t\t\t\t<redirect_mode>" . $config->redirect_mode . "</redirect_mode>\n";
					    $contenido .= "\t\t\t\t<redirect>" . $config->redirect . "</redirect>\n";
					    $contenido .= "\t\t\t\t<description>" . $config->description . "</description>\n";
					    $contenido .= "\t\t\t\t<enablelog>" . $config->enablelog . "</enablelog>\n";
				    $contenido .= "\t\t\t</config>\n";
				}
				$contenido .= "\t\t\t<config>\n";
					$contenido .= "\t\t\t\t<name>" . $request->name . "</name>\n";
				    $contenido .= "\t\t\t\t<domains>" . $request->domain_list . "</domains>\n";
				    $contenido .= "\t\t\t\t<urls>" . $request->url_list . "</urls>\n";
				    $contenido .= "\t\t\t\t<expressions>" . $request->expression_regular . "</expressions>\n";
				    $contenido .= "\t\t\t\t<redirect_mode>" . $request->mode_redirect . "</redirect_mode>\n";
				    $contenido .= "\t\t\t\t<redirect>" . $request->redirect . "</redirect>\n";
				    $contenido .= "\t\t\t\t<description>" . $request->description . "</description>\n";
				    $contenido .= "\t\t\t\t<enablelog>" . $request->log . "</enablelog>\n";
			    $contenido .= "\t\t\t</config>\n";
	    	$contenido .= "\t\t</squidguarddest>";
			$archivo = fopen("clients/$name_group/$campus/info_squidguarddest.xml", 'w');
			fwrite($archivo, $contenido);
			fclose($archivo);
			# Archivo de cambios #
			$archivo_cambio = fopen("clients/$name_group/$campus/change_squidguarddest.xml", 'w');
			fwrite($archivo_cambio, $contenido);
			fclose($archivo_cambio);
		}
		$role= \Auth::user()->role;
        if($role === 'SUPER')
			return redirect()->route('showGroupsTarget')->with('success','Registry created successfully.');
		if($role === 'ADMIN'){
			return redirect()->route('showDevicesTarget', $id)->with('success','Registry created successfully.');
		}
    }

    public function editTargetDevice($name, $id, $campus)
    {
    	$name_group = $this->name_group($id);
    	$xml = simplexml_load_file("clients/$name_group/$campus/info_squidguarddest.xml");
    	foreach($xml->config as $config)
		{
			if($config->name == $name )
			{
				$name_target = $config->name;
				$domain_list = $config->domains;
				$url_list = $config->urls;
				$expression_regular = $config->expressions;
				$mode_redirect = $config->redirect_mode;
				$redirect = $config->redirect;
				$description = $config->description;
				$log = $config->enablelog;
				break;
			}
		}
    	return view('target.editTargetDevice',compact(
    		'id','name','campus','name_target','domain_list','url_list','expression_regular','mode_redirect','redirect','description','log'));
    }

    public function editTargetDevicePost(Request $request, $name, $id, $campus)
    {
    	$this->validate($request,[ 
            'name' => 'required',
            'domain_list' => 'required',
            'url_list' => 'required',
            'expression_regular' => 'required',
        ]);
    	$name_group = $this->name_group($id);
    	$xml = simplexml_load_file("clients/$name_group/$campus/info_squidguarddest.xml");
    	foreach($xml->config as $config)
		{
			if($config->name == $request->name)
			{
				$config->domains = $request->domain_list;
				$config->urls = $request->url_list;
				$config->expressions = $request->expression_regular;
				$config->redirect_mode = $request->mode_redirect;
				$config->redirect = $request->redirect;
				$config->description = $request->description;
				$config->enablelog = $request->log;
			}
		}
		$xml->asXML("clients/$name_group/$campus/info_squidguarddest.xml");
		$contenido = "\t\t<squidguarddest>\n";
		foreach($xml->config as $config)
		{
		    $contenido .= "\t\t\t<config>\n";
		    $contenido .= "\t\t\t\t<name>" . $config->name . "</name>\n";
		    $contenido .= "\t\t\t\t<domains>" . $config->domains . "</domains>\n";
		    $contenido .= "\t\t\t\t<urls>" . $config->urls . "</urls>\n";
		    $contenido .= "\t\t\t\t<expressions>" . $config->expressions . "</expressions>\n";
		    $contenido .= "\t\t\t\t<redirect_mode>" . $config->redirect_mode . "</redirect_mode>\n";
		    $contenido .= "\t\t\t\t<redirect>" . $config->redirect . "</redirect>\n";
		    $contenido .= "\t\t\t\t<description>" . $config->description . "</description>\n";
		    $contenido .= "\t\t\t\t<enablelog>" . $config->enablelog . "</enablelog>\n";
		    $contenido .= "\t\t\t</config>\n";
		}
	    $contenido .= "\t\t</squidguarddest>";
		$archivo = fopen("clients/$name_group/$campus/info_squidguarddest.xml", 'w');
		fwrite($archivo, $contenido);
		fclose($archivo);
		# Archivo de cambios #
		$archivo_cambio = fopen("clients/$name_group/$campus/change_squidguarddest.xml", 'w');
		fwrite($archivo_cambio, $contenido);
		fclose($archivo_cambio);
		return redirect()->route('showTargetDevice', ['id' =>$id, 'name' => $campus])->with('success','Registry created successfully.');
    }

    public function deleteTargetDevice($name, $id, $campus)
    {
    	$name_group = $this->name_group($id);
        $libreria_dom = new \DOMDocument; 
	    $libreria_dom->load("clients/$name_group/$campus/info_squidguarddest.xml");
	    $squidguarddest = $libreria_dom->documentElement;
	    $config = $squidguarddest->getElementsByTagName('config');
	    foreach ($config as $nodo) 
	    {
	    	$uri = $nodo->getElementsByTagName('name');
        	$valor = $uri->item(0)->nodeValue;
	        if($valor == $name)
	            $squidguarddest->removeChild($nodo);
	    }
	    $libreria_dom->save("clients/$name_group/$campus/info_squidguarddest.xml");
	    $xml = simplexml_load_file("clients/$name_group/$campus/info_squidguarddest.xml");
		$contenido = "\t\t<squidguarddest>\n";
		foreach($xml->config as $config)
		{
		    $contenido .= "\t\t\t<config>\n";
		    $contenido .= "\t\t\t\t<name>" . $config->name . "</name>\n";
		    $contenido .= "\t\t\t\t<domains>" . $config->domains . "</domains>\n";
		    $contenido .= "\t\t\t\t<urls>" . $config->urls . "</urls>\n";
		    $contenido .= "\t\t\t\t<expressions>" . $config->expressions . "</expressions>\n";
		    $contenido .= "\t\t\t\t<redirect_mode>" . $config->redirect_mode . "</redirect_mode>\n";
		    $contenido .= "\t\t\t\t<redirect>" . $config->redirect . "</redirect>\n";
		    $contenido .= "\t\t\t\t<description>" . $config->description . "</description>\n";
		    $contenido .= "\t\t\t\t<enablelog>" . $config->enablelog . "</enablelog>\n";
		    $contenido .= "\t\t\t</config>\n";
		}
	    $contenido .= "\t\t</squidguarddest>";
		$archivo = fopen("clients/$name_group/$campus/info_squidguarddest.xml", 'w');
		fwrite($archivo, $contenido);
		fclose($archivo);
		# Archivo de cambios #
		$archivo_cambio = fopen("clients/$name_group/$campus/change_squidguarddest.xml", 'w');
		fwrite($archivo_cambio, $contenido);
		fclose($archivo_cambio);
        return Redirect::back()->with('success','Registry successfully deleted.');
    }

    #FUNCIONES CONSULTAS BASE DE DATOS#
    private function name_group($id)
    {
        $name_group = DB::table('groups')->select('name')->where('id', '=', $id)->get();
        foreach ($name_group as $group_name) {
            foreach ($group_name as $id) {
                $id;
            }
        }
        return $id;
    }
}