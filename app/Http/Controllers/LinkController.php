<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Link;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Nette\Utils\Random;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class LinkController extends Controller
{
    /**
     * 显示当前用户的所有链接
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::paginate(5);
        return view('links.index', ['links' => $links]);
    }

    /**
     * 新链接的创建页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('links.create');
    }

    /**
     * 新链接发送到服务器
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 判断是否为空
        if(empty($request->allFiles()))
        {
            return back()->withErrors('请选择文件');
        }

        // 获取所有文件的信息
        $files = $request->allFiles()["file"];

        //生成随机的提取码
        $code = Random::generate(4);

        if(is_array($files))
        {
            $filenames = array();   //存储所有文件的名字

            foreach($files as $file)
            {
                //获取文件的原始名字
                $origin_filename = $file->getClientOriginalName();
                
                //保存文件并获取存储的路径
                $path = Storage::putFile('files', $file);

                //将存储路径保存至数组中
                array_push($filenames, $path);

                //将文件名和原始名字存储至数据库
                //TODO
                DB::table('files')->insert([
                    'name' => $path,
                    'origin_name' => $origin_filename,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);
            }
            //存储将要保存的json数据
            $json_file = json_encode(array('file'=>$filenames));

            //将链接的数据保存到数据库并获取ID
            $id = DB::table('links')->insertGetId([
                'user_id' => auth()->id(),
                'code' => $code,
                'files' => $json_file,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
        }
        else
        {
            return back()->withErrors('发生错误，请重试');
        }
        //返回ID和提取码
        return back()->with(['id'=>$id, 'code'=>$code]);
    }

    /**
     * 从服务器删除这个链接
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        $file_list = json_decode(Link::find($link->id)->files)->file;
        foreach($file_list as $file)
        {
            // 从数据库中删除对应的文件数据
            DB::table('files')->where('name', $file)->delete();

            //删除存储的文件
            Storage::delete($file);
        }
        
        //删除对应的链接数据
        $link->delete();
        
        return response('success', 200);
    }

    /**
     * 进入别人发布的链接
     */
    public function get_link($id)
    {
        if(!Link::find($id)) return response('', 404);
        return view('links.get',['id' => $id]);
    }

    /**
     * 检验提取码是否正确
     */
    public function post_link(Request $request, $id)
    {
        if(!Link::find($id)) return response('', 404);
        $link = Link::find($id);
        if($request->input('code')!=$link->code)return back()->withErrors('提取码错误');
        $file_list = json_decode($link->files)->file;

        //获取对应的文件原始名
        $origin_name_list = array();
        foreach($file_list as $file)
        {
            if(DB::table('files')->where('name', $file)->exists())
            {
                $orogin_file_name = DB::table('files')->where('name', $file)->value('origin_name');
                $origin_name_list[$file] = $orogin_file_name;
            }
        }
        
        return back()->with(['id' => $id, 'origin_name_list' => $origin_name_list]);
    }

    /**
     * 返回下载的链接
     */
    public function download(Request $request, $file)
    {
        $file = 'files/'.$file;
        if(!Storage::exists($file)) return back()->withErrors('找不到文件');
        return Storage::download($file, DB::table('files')->where('name', $file)->value('origin_name'));
    }
}
