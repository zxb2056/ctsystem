var E = window.wangEditor
var editor = new E('#postcontent')

editor.customConfig.uploadImgServer = '/admin/posts/image/upload'
editor.customConfig.uploadFileName = 'wangEditorFile'
editor.customConfig.uploadImgMaxSize = 1 * 1024 * 1024

// // 设置 headers（举例）
editor.customConfig.uploadImgHeaders = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
// 上传文件监听
editor.customConfig.uploadImgHooks = {
    customInsert: function (insertImg, result, editor) {
        var url = result.data
        //上传图片回填富文本编辑器
        insertImg(url)

    }
}
editor.create();

  // 赋值给input
    function getContent()
    {
      var content= $('#postcontent').html()
      var upstr=wangfilter(content)
      document.getElementById("subcontent").value=upstr

var imgReg = /<img.*?(?:>|\/>)/gi;
var srcReg = /src=[\'\"]?[^\'\"]*[\'\"]?/i;
var arr = upstr.match(imgReg);
var href=""
var src=""
if(arr){
for (var i = 0; i < arr.length; i++) {
src = arr[i].match(srcReg);
src= src.toString().replace(/src=[\'\"]?([^\'\"]*)\/\/.*?\//g,'') + ","
src=src.replace(/[\'|\"]/g,'')
href +=src
}
if (href.length > 0) {
    href= href.substr(0, href.length - 1);
  }
}
document.getElementById("piclink").value=href
     }
     //html过滤
    function wangfilter(text){
        var str=text
          str2=str.replace(/\s{2,}/g,'')
          str2=str2.replace(/^[(\s+)(<div)].+contenteditable.+?>/g,'')
          str2=str2.replace(/(<\/div>){2}$/g,'')
          str2=str2.replace(/border="0"\swidth="100%"/g,'class="table table-hover table-sm table-responsive d-flex justify-content-center"')
          str2=str2.replace(/<tbody>/g,'<tbody class="table-bordered">')
          str2=str2.replace(/<img/g,'<img class="rounded mx-auto d-block" ')
          return str2
    }

$(document).ready(function () {

    // Firefox和Chrome早期版本中带有前缀
      var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver
      // 选择目标节点
      var target = document.querySelector('#postcontent')
      // 创建观察者对象
      var observer = new MutationObserver(function(mutations){ 
      mutations.forEach(function(mutation) {
          if(mutation.removedNodes[0] !=null )
         {
            if(mutation.removedNodes[0].tagName ==  "IMG")
            {
             document.onkeydown=function(e){
                if(e.keyCode==8 || e.keyCode==46){ 
               var href = location.href; //当前路径
               href = href.substring(0,href.lastIndexOf("/")+1);
               var imgSrc =mutation.removedNodes[0].src;
               imgSrc = imgSrc.replace(href,''); //一种分离相对路径很笨的办法
               imgSrc = imgSrc.replace(/^http:\/{1}.+?\//g,'')
               $.ajax({
                  type: "GET",
                  url: "/admin/photo/edit/delete",  //同目录下的php文件
                  data:{imgSrc,imgSrc},
                   success: function(msg){  //请求成功后的回调函数
                    alert(msg);
                    $("#postcontent").children("img").remove();  //删除DOM节点
            }
        
        });
    }
             }
         }
        }
 
  
      })
    })
      // 配置观察选项:
      var config = { attributes: true, childList: true, characterData: true ,subtree:true }
      // 传入目标节点和观察选项
      observer.observe(target, config);
  
    }  )
