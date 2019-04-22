			var phoneReg = /(^1[3|4|5|7|8]\d{9}$)|(^09\d{8}$)/;//手机号正则 
			var count = 60; //间隔函数，1秒执行
			var InterValObj; //timer变量，控制时间
			var curCount;//当前剩余秒数
			/*第一*/
			
			function sendMessage() {
			
				curCount = count;		 		 
				var phone = $.trim($('#phone').val());
				if (!phoneReg.test(phone)) {
					alert(" 请输入有效的手机号码"); 
					return false;
				}
				
				//设置button效果，开始计时
				$("#yzphone").attr("disabled", "true");
				$("#yzphone").val('请等' + curCount + "秒再获取");
				InterValObj = window.setInterval(SetRemainTime, 1000); //启动计时器，1秒执行一次
				//向后台发送处理数据
					 
			}
			function SetRemainTime() {
				if (curCount == 0) {                
					window.clearInterval(InterValObj);//停止计时器
					$("#yzphone").removeAttr("disabled");//启用按钮
					$("#yzphone").val("重新发送");
				}
				else {
					curCount--;
					$("#yzphone").val( '请等'+ curCount + "秒再获取");
				}
			} 
			
			/*提交*/
			function binding(){
				alert(1)
			}
