<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UploadsManager;
use App\Http\Requests\UploadNewFolderRequest;
use App\Http\Requests\UploadFileRequest;
use Illuminate\Support\Facades\File;

class UploadController extends Controller
{

    protected $manager;

    public function __construct(UploadsManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $folder = $request->get('folder');
        $data = $this->manager->folderInfo($folder);
        return view('admin.upload.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function createFolder(UploadNewFolderRequest $request)
    {
        $new_folder = $request->get('new_folder');
        $folder = $request->get('folder') . '/' . $new_folder;
        $result = $this->manager->createDirectory($folder);
        if ($result === true) {
            return redirect()->back()->withSuccess("Folder '$new_folder' created.");
        }
        
        $error = $result ?  : "An error occurred creating directory.";
        return redirect()->back()->withErrors([
            $error
        ]);
    }

    public function deleteFile(Request $request)
    {
        $del_file = $request->get('del_file');
        $path = $request->get('folder') . '/' . $del_file;
        
        $result = $this->manager->deleteFile($path);
        if ($result === true) {
            return redirect()->back()->withSuccess("File '$del_file' deleted.");
        }
        
        $error = $result ?  : "An error occurred deleting file.";
        return redirect()->back()->withErrors([
            $error
        ]);
    }

    public function deleteFolder(Request $request)
    {
        $del_folder = $request->get('del_folder');
        $folder = $request->get('folder') . '/' . $del_folder;
        
        $result = $this->manager->deleteDirectory($folder);
        
        if ($result === true) {
            return redirect()->back()->withSuccess("Folder '$del_folder' deleted.");
        }
        
        $error = $result ?  : "An error occurred deleting directory.";
        return redirect()->back()->withErrors([
            $error
        ]);
    }

    /**
     * 上传文件
     */
    public function uploadFile(UploadFileRequest $request)
    {
        $file = $_FILES['file'];
        $fileName = $request->get('file_name');
        $fileName = $fileName ?  : $file['name'];
        $path = str_finish($request->get('folder'), '/') . $fileName;
        $content = File::get($file['tmp_name']);
        
        $result = $this->manager->saveFile($path, $content);
        
        if ($result === true) {
            return redirect()->back()->withSuccess("File '$fileName' uploaded.");
        }
        
        $error = $result ?  : "An error occurred uploading file.";
        return redirect()->back()->withErrors([
            $error
        ]);
    }
}
