<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>河南省国家税务局互联网申报系统</title>
    <script src="/12366/www.12366.ha.cn/Public/ext/ext-all.js"></script>
<script src="/12366/www.12366.ha.cn/Public/ext/bootstrap.js"></script>
<script src="/12366/www.12366.ha.cn/Public/ext/packages/ext-locale/build/ext-locale-zh_CN.js"></script>
<link href="/12366/www.12366.ha.cn/Public/ext/packages/ext-theme-classic/build/resources/ext-theme-classic-all.css" rel="stylesheet" />
<!--<link href="/12366/www.12366.ha.cn/Public/ext/packages/ext-theme-neptune/build/resources/ext-theme-neptune-all.css" rel="stylesheet" />-->
<!--<link href="/12366/www.12366.ha.cn/Public/ext/packages/ext-theme-gray/build/resources/ext-theme-gray-all.css" rel="stylesheet" />-->
    <script type="text/javascript">
    Ext.onReady(function() {

        var tabpanel = new Ext.TabPanel({
            id: 'tabpanel',
            deferredRender: true,
            activeTab: 0,
            items: [
                {
                    title: '我的主页',
                    html: '<iframe frameborder="0" src="/12366/www.12366.ha.cn/Application/Home/Common/html/home.html"  width="100%" height="100%"></iframe>',
                    icon: 'home'
                }
            ]
        });

        var viewPort = new Ext.Viewport({
            layout: "border",
            renderTo: Ext.getBody(),
            items: [{
                id:"north",
                region: "north",
                border: false,
                height: 100,
                html: '<iframe frameborder="0" src="/12366/www.12366.ha.cn/Application/Home/Common/html/top.html" height="100%" width="100%"></iframe>'
            },{
                id:"south",
                region: "south",
                border: false,
                height: 30,
                html: '<div style="padding-top: 6px; padding-right: 30px; text-align: right;">技术支持：航天金穗 河南百旺</div>'
            },{
                id: "east",
                region: "east",
                border: false,
                width: 5
            },{
                id: "west",
                title: '功能菜单',
                region: "west",
                split: true,
                collapsible: true,
                width: 300,
                html:'<div id="div-west"></div>'
            },{
                id: 'center',
                region: "center",
                split: false,
                border: false,
                items: tabpanel
            }]
        });

        // 设置tabpanel的高度
        tabpanel.setHeight(Ext.get('center').getHeight());


        /**
         * tree
         * 在这里添加树节点
         */
        var treepanel = Ext.create('Ext.tree.Panel', {
            id: 'treeview',
            rootVisible: true,
            border: false,
            renderTo: 'div-west',
            store: Ext.create('Ext.data.TreeStore', {
                root: {
                    text: '我的权限',
                    expanded: true,
                    children: [{
                        text: "增值税（一般纳税人使用）",
                        expanded: true,
                        children: [{
                            text: "增值纳税申报表（一般纳税人使用）",
                            leaf: true,
                            url: "/12366/www.12366.ha.cn/index.php/Home/TableNode1/table1"
                        },{
                            text: "增值纳税申报表附列资料（一）",
                            leaf: true,
                            url: "/12366/www.12366.ha.cn/index.php/Home/TableNode1/table2"
                        }]
                    }]
                }
            })
        });

        treepanel.on({
            //单击事件
            'itemclick': function(view, rcd, item, idx, event, eOpts) {
                var url = rcd.get('url');
                var text = rcd.get('text');
                if (url) {
                    var items = tabpanel.items.items;
                    for (var i=0; i< items.length; i++) {
                        if (items[i].title == text && items[i].url == url) {
                            tabpanel.setActiveTab(i);
                            return;
                        }
                    }
                    tabpanel.add({
                        url: url,
                        title: text,
                        closable: true,
                        html: "<iframe frameborder='0' src=" + url + " width='100%' height='100%'></iframe>"
                    }).show();
                }
            }
        });

     });

</script>
</head>
<body>
</body>
</html>