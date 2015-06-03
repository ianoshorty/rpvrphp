<?php namespace App\Http\Controllers;

use App\Http\Requests\DownloadRequest;
use Illuminate\Support\Facades\Request;
use Axel\AxelDownload;

class DownloadController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Download Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "download page" for the application
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index() {
		return view('content');
	}

    /**
     * Starts a static download
     *
     * @param DownloadRequest $request The validated download request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function download(DownloadRequest $request) {

        $download = $request->all();

        $axel = new AxelDownload();
        $axel->start($download['url'], $download['filename'], null, function(AxelDownload $axel, $status, $complete, $error) {

            if (empty($error)) $axel->clearCompleted();
            else dd($axel);
        });

        return redirect('/');
    }

}
