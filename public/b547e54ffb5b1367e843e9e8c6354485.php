<?php /*a:1:{s:23:"../view/grade-edit.html";i:1577320680;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.2</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="./css/font.css">
    <link rel="stylesheet" href="./css/xadmin.css">
    <script type="text/javascript" src="./lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="./js/xadmin.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]--></head>

<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form">
            <div class="layui-form-item">
                <div class="layui-form-item">
                    <label class="layui-form-label">学号</label>
                <div class="layui-input-block">
                    <input value="<?php echo htmlentities($data['STUDENTID']); ?>" id="studentid" type="text" name="studentid" lay-verify="studentid" autocomplete="off" placeholder="请输入学号" class="layui-input">
                </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-form-item">
                    <label class="layui-form-label">科目</label>
                    <div class="layui-input-block">
                        <input value="<?php echo htmlentities($data['SUBJECT']); ?>" id="subject" type="text" name="subject" lay-verify="subject" autocomplete="off" placeholder="请输入科目" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-form-item">
                    <label class="layui-form-label">成绩</label>
                    <div class="layui-input-block">
                        <input value="<?php echo htmlentities($data['GRADE']); ?>" id="grade" type="text" name="grade" lay-verify="grade" autocomplete="off" placeholder="请输入成绩" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-form-item">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-block">
                        <input value="<?php echo htmlentities($data['STATUS']); ?>" id="status" type="text" name="status" lay-verify="status" autocomplete="off" placeholder="请输入转态" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <button lay-filter="edit" lay-submit="" class="layui-btn layui-btn-fluid">保存修改</button>
            </div>
        </form>
    </div>
</div>

<script>layui.use(['form', 'layer'],
    function() {
        $ = layui.jquery;
        var form = layui.form,
            layer = layui.layer;

        //自定义验证规则
        form.verify({
            studentid:function (value) {
                if(isNaN(parseInt(value))){
                    return '请输入正确的学号!';
                }
            },
            subject: function(value) {
                if (value.length===0){
                    return '请输入学科！';
                }
            },
            grade:function (value) {
                if(!value){
                    return '请输入成绩！';
                }

            },
            status:function (value) {
                if(value.length===0){
                    return '请输入状态！';
                }
            }
        });

        //监听提交
        form.on('submit(edit)',
            function(data) {
                console.log(data.field);
                //使用ajax传递数据
                senddata=$.ajax({
                    type:"POST",
                    url:"/tools/changAdd",
                    data:{
                        id:<?php echo htmlentities($id); ?>,
                        subject:data.field.subject,
                        grade:data.field.grade,
                        studentid:data.field.studentid,
                        status:data.field.status,
                        option:'edit',
                        type:'grade'
                    },
                    success:function (msg) {
                        //发异步，把数据提交给php
                        console.log(msg);
                        if(msg==='ok'){
                            parent.location.reload();
                            layer.alert('修改成功！', {
                                    icon: 6
                                },
                                function() {
                                    // 获得frame索引
                                    var index = parent.layer.getFrameIndex(window.name);
                                    //刷新页面
                                    parent.layer.close(index);
                                });
                        }else {
                            layer.alert('修改失败！', {icon: 5});
                        }
                    },
                    error:function () {
                        layer.alert('修改失败！',{icon: 5})
                    }
                });
                //等待ajax执行完毕
                $.when(senddata).done(function (value) {

                });
                return false;
            });
    });</script>
</body>
</html>