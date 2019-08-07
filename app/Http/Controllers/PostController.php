<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;
use App\Bulletin;
use App\Video;
use App\Tupian;
use App\Comment;
use App\Zan;
use App\Posttype;

class PostController extends Controller
{
     // 文章列表
    public function list(Request $request){
            $datas=$request->all();
            $datas['showitem']=$request->input('showitem',6);//如果没有传值，默认6。
            $datas['posttitle']=$request->input('posttitle','');
            $datas['startdate']=$request->input('startdate','');
            $datas['stopdate']=$request->input('stopdate','');
            $posts=Post::orderBy('id','desc')
            ->where(function($query) use($request){
                $title=$request->posttitle;
                if(!empty($title)){
                $query->where('title','like','%'.$title.'%');
                }
            })
                ->where(function($query) use($request){
                    $startdate=$request->startdate;
                    $stopdate=$request->stopdate;
                    if(!empty($startdate) && !empty($stopdate)){
                    $query->whereBetween('created_at',[$startdate, $stopdate]);
                    }
                })
            ->withcount('comments')
            ->with(['posttype'])
            ->paginate($request->input('showitem',6));
            
                return view('admin.postlist',compact('posts','datas'));
    }
    
    //创建文章
    public function input(){
        return view('admin.postinput');
    }
    //创建文章逻辑
    public function store(Request $request){
        // dd($request->all());
         //验证
        $this->validate($request,[
            'title'=>'required|string|max:100',
            'content'=>'required|string|min:10',
        ],[
            'title.max'=>'文章标题过长',
            'content.min'=>'文章内容过短',
        ]);
        if(\Auth::id()){
                    $admin_user_id = \Auth::id();
                    }
                    else {
                        $admin_user_id='';
                    }
        //上传
        if($request->hasFile('lunboLink') && $request->file('lunboLink')->isValid()){
                $path='./uploads/'.date('Ymd');
                $filename =date("Y-m-d").'-'.date("H").date("i").date("s").'-'.rand(1000, 9999).'.'.$request->file('lunboLink')->getClientOriginalExtension();
                $request->file('lunboLink')->move($path,$filename);
                $data= $request->all();
                $data['lunboLink']= trim($path.'/'.$filename);
                $data['admin_user_id']=$admin_user_id;
               Post::create($data);
            }else{
                $data= $request->all();
                $data['admin_user_id']=$admin_user_id;
                Post::create($data);
            }
    //渲染
        return redirect('/admin/post/postlist');
    }
    //文章中wangeditor图片上传
    public function imageUpload(Request $request){
        //获取文件绝对路径，获得其内容，随后将其上传到磁盘。
        $path=$request->file('wangEditorFile')->getRealPath();
        //获取文件扩展名
        $ext=$request->file('wangEditorFile')->getClientOriginalExtension();
        //文件重命名
        $filename=date('Y-m-d-h-i-s').'-'.rand(1000,9999).'.'.$ext;
        Storage::disk('public')->put($filename,file_get_contents($path));

        $data = asset('storage/' . $filename);
        echo json_encode(array(
        "error" => 0,
        "data" => $data,
    ));



    }
    //编辑文章
    public function edit($id){
        // 
        $posts=Post::findorFail($id);
        // dd($posts->content);
        return view('admin.post_edit',compact('posts'));
    }
    //编辑文章逻辑
    public function update(Request $request){
      $post=Post::findOrFail($request->id);
      if($request->hasFile('lunboLink') && $request->file('lunboLink')->isValid()){
        //  dd($request->all());
            $path='./uploads/'.date('Ymd');
            $filename =date("Y-m-d").'-'.date("H").date("i").date("s").'-'.rand(1000, 9999).'.'.$request->file('lunboLink')->getClientOriginalExtension();
            $request->file('lunboLink')->move($path,$filename);
            $data= $request->all();
            $data['lunboLink']= trim($path.'/'.$filename);
           $post->update($data);
           return redirect('/admin/post/postlist');
        }else{
        $data= $request->all();
        $post->update($data);
        return redirect('/admin/post/postlist');
        }
    }
    //删除文章逻辑
    public function delete($id){
      
        $post=Post::findOrFail($id);
        //删除关联的轮播图片
        $profile=$post->lunboLink;
        if(file_exists($profile)){
            unlink($profile);
        }
        if(!empty($post->piclink)){
            $picprofile = explode(',',$post->piclink); 
            for($index=0;$index<count($picprofile);$index++) 
            { 
                if(file_exists($picprofile[$index])){
                unlink($picprofile[$index]);
              
                }
            } 
        }
        //有时候进行软删除
        $post->delete();
        return redirect('/admin/post/postlist');
    }
   
    // 公告板
    public function bulletin() {
        return view('admin.bulletin');
    }
    // 视频
    public function video() {
        $videos = Video::orderBy('id','desc')->paginate(10);
        return view('admin.video',compact('videos'));
    }
    //视频存储
    public function videostore(Request $request){
        
        $data= $request->all();
        Video::create($data);
        return redirect()->back();
        
    }
    //视频更新
    public function videoUpdate(Request $request){
        
        $video=Video::findOrFail($request->id);
        $data=$request->all();
        $video->update($data);
        return redirect()->back();
    }
    //视频删除
    public function videoDelete($id){
        $video=Video::findOrFail($id);
        $video->delete();
        return redirect()->back();
    }
    // 图片
    public function picture() {
        $tupians=Tupian::orderBy('id','desc')->paginate(10);
        return view('admin.picture',compact('tupians'));
    }
    //储存图片
    public function photostore(Request $request){
        if($request->hasFile('photoLink') && $request->file('photoLink')->isValid()){
            $path='./uploads/tupian/'.date('Ymd');
            $filename =date("Y-m-d").'-'.date("H").date("i").date("s").'-'.rand(1000, 9999).'.'.$request->file('photoLink')->getClientOriginalExtension();
            $request->file('photoLink')->move($path,$filename);
            $data= $request->all();
            $data['photoLink']= trim($path.'/'.$filename);
            Tupian::create($data);
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
    //更新图片标题，描述
    public function photoUpdate(Request $request){
       
        $photo=Tupian::findOrFail($request->id);
        $data=$request->all();
        $photo->update($data);
        return redirect()->back();

    }
    public function photoDelete($id){
       
        $photo=Tupian::findOrFail($id);
        $profile=$photo->photoLink;
        
        if(file_exists($profile)){
            unlink($profile);
        }
        $photo->delete();
        return redirect()->back();

    }
    //编辑器图片实时删除
    public function editorphotoDelete(Request $request){
        $imgSrc =$request->imgSrc;
        if(file_exists($imgSrc)) {//
    	if(unlink($imgSrc)){
          echo "图片删除成功！";  //php删除文件函数unlink();
        }
		else{
            echo "删除不成功！";
        }
        }
    }

    //公告板存储
    public function bulletinstore(Request $request){
  
            if($request->hasFile('bulletinPhoto') && $request->file('bulletinPhoto')->isValid()){
          
            $path='./uploads/bulletin/'.date('Ymd');
            $filename =date("Y-m-d").'-'.date("H").date("i").date("s").'-'.rand(1000, 9999).'.'.$request->file('bulletinPhoto')->getClientOriginalExtension();
            $request->file('bulletinPhoto')->move($path,$filename);
            $data= $request->all();
            // dd($data);
            $data['bulletinPhoto']= trim($path.'/'.$filename);
            Bulletin::create($data);
           return redirect('/admin/post/bulletinlist');
            }else {
                
                return ;
                    }
        }
    //公告板列表 
    public function bulletinlist(){
        $bulletins=Bulletin::orderBy('id','desc')->paginate(10);
        return view('admin.bulletinlist',compact('bulletins'));
    }
     // 公告编辑
    public function bulletin_edit($id){
       
        $bulletins=Bulletin::findorFail($id);
     
        return view('admin.bulletin_edit',compact('bulletins'));
    }
    //公告更新
    public function bulletin_update(Request $request){

  
        $bulletin=Bulletin::findOrFail($request->id);
        if($request->hasFile('bulletinPhoto') && $request->file('bulletinPhoto')->isValid()){
          
            $path='./uploads/bulletin/'.date('Ymd');
            $filename =date("Y-m-d").'-'.date("H").date("i").date("s").'-'.rand(1000, 9999).'.'.$request->file('bulletinPhoto')->getClientOriginalExtension();
            $request->file('bulletinPhoto')->move($path,$filename);
            $data= $request->all();
            $data['bulletinPhoto']= trim($path.'/'.$filename);
            $bulletin->update($data);
           return redirect('/admin/post/bulletinlist');
            }else {
                $data=$request->all();
                $bulletin->update($data);
                return redirect('/admin/post/bulletinlist');
            }
    }
    //公告删除
    public function bulletin_delete($id){
        $bulletin=Bulletin::findOrFail($id);
        //删除关联的轮播图片
        $profile=$bulletin->bulletinPhoto;
        if(file_exists($profile)){
            unlink($profile);
        }
        //有时候进行软删除
        $bulletin->delete();
        return redirect('/admin/post/bulletinlist');
    }
    //添加评论
    public function comment(Post $post)
    {
        $this->validate(request(),[
            'content'=>'required|min:3|max:120',

        ],['content.min'=>'评论最少3个字',]);
        //逻辑
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content = request('content');
        $post->comments()->save($comment);

        //渲染
        return back();
    }
    public function zan($post_id)
    {
        $parm = [
            'user_id'=> \Auth::id(),
            'post_id'=> $post_id,
        ];
        Zan::firstOrCreate($parm);
        return redirect()->back();
    }
    public function unzan($post_id)
    {
        $post=Post::findOrFail($post_id);
        $post->zan(\Auth::id())->delete();
        return back();
    }
    public function examcommen($postid){
        $comments=Comment::withoutGlobalScope('avalable')->where('status',0)->orderBy('id','desc')->where('post_id',$postid)->with(['user'])->paginate(10);
        $postTitle=Post::find($postid)->title;
        return view('admin.examcommen',compact('comments','postTitle'));
    }
    public function status($commentid){
         $this->validate(request(),[
            'status' => 'required|in:-1,1'
        ]);
        
        $comments=Comment::find($commentid);
        $comments->status = request('status');
        $comments->save();
        
            return [
                'error'=> 0,
                'msg' =>'',
            ];
    }


}
