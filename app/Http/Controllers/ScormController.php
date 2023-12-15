<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Peopleaps\Scorm\Exception\InvalidScormArchiveException;
use Peopleaps\Scorm\Exception\StorageNotFoundException;
use Peopleaps\Scorm\Manager\ScormManager;
use Peopleaps\Scorm\Model\ScormModel;

class ScormController extends Controller
{
    /** @var ScormManager $scormManager */
    private $scormManager;
    /**
     * ScormController constructor.
     * @param ScormManager $scormManager
     */
    public function __construct(ScormManager $scormManager)
    {
        $this->scormManager = $scormManager;
    }

    public function show($id)
    {
        $item = ScormModel::with('scos')->findOrFail($id);
        $xml = simplexml_load_file('scorm/4dfc3403-8062-418e-8d75-e4d60211f3cf/imsmanifest.xml');
        $xml = file_get_contents('scorm/4dfc3403-8062-418e-8d75-e4d60211f3cf/imsmanifest.xml');
        return response(file_get_contents('scorm/4dfc3403-8062-418e-8d75-e4d60211f3cf/imsmanifest.xml'), 200, [
            'Content-Type' => 'application/xml'
        ]);
        return view('show', [
                'xml' => $xml
            ]);
        $exampleString = $xml->asXML();
        dd($exampleString);
        return response($exampleString, 200, [
            'Content-Type' => 'application/xml'
        ]);
        // response helper function from base controller reponse json.
        return response()->json($exampleString)->header('Content-Type', 'application/xml');
    }

    public function store(Request $request)
    {
        try {
            $scorm = $this->scormManager->uploadScormArchive($request->file('file'));
            // handle scorm runtime error msg
        } catch (InvalidScormArchiveException | StorageNotFoundException $ex) {
            return $this->respondCouldNotCreateResource(trans('scorm.' .  $ex->getMessage()));
        }

        // response helper function from base controller reponse json.
        return response()->json(ScormModel::with('scos')->whereUuid($scorm['uuid'])->first());
    }

    public function saveProgress(Request $request)
    {
        dd($request->all());
    }
}
