<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>安生举图 1-209 · 完整显示</title>
    <style>
        /* 极简重置 */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            padding: 20px;
        }

        /* 网格布局：每行尽可能多，最小180px（稍微调大一点让图片更舒服） */
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
            max-width: 1800px;
            margin: 0 auto;
        }

        /* 卡片：纯白背景，细边框 */
        .card {
            background: white;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #eaeaea;
            aspect-ratio: 1 / 1;
            position: relative;
            transition: box-shadow 0.2s;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border-color: #ccc;
        }

        /* 图片完全显示，不留白边裁剪 */
        .card img {
            width: 100%;
            height: 100%;
            object-fit: contain;  /* 关键修改：contain 保证完整显示 */
            display: block;
            background: #fafafa;  /* 极浅灰背景，让有留白的图片看起来柔和 */
            padding: 4px;         /* 稍微内缩一点，避免图片贴边 */
        }

        /* 序号：黑底半透明，圆角矩形，放在图片上方（不遮挡主体） */
        .index {
            position: absolute;
            top: 10px;
            left: 10px;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 4px 10px;
            border-radius: 20px;   /* 圆角标签 */
            font-size: 12px;
            font-weight: 500;
            backdrop-filter: blur(2px);
            border: 1px solid rgba(255,255,255,0.2);
            z-index: 2;
            line-height: 1.2;
            letter-spacing: 0.3px;
        }

        /* 页面标题 - 极小化，不占空间 */
        .page-title {
            text-align: center;
            margin-bottom: 25px;
            font-size: 14px;
            color: #888;
            font-weight: 400;
            letter-spacing: 1px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 15px;
        }

        /* 移动端适配 */
        @media  {
            body { padding: 12px; }
            .grid { gap: 12px; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); }
            .index { font-size: 11px; padding: 3px 8px; top: 6px; left: 6px; }
            .card img { padding: 2px; }
        }
    </style>
</head>
<body>
    <!-- 极简标题 -->
    <div class="page-title">安生 · 1 → 209 · 完整显示</div>

    <div class="grid" id="gallery">
        <!-- 所有图片由JavaScript生成 -->
    </div>

    <script>
        (function() {
            const gallery = document.getElementById('gallery');
            const TOTAL = 209; // 从1到209
            
            // 清空并一次性生成所有图片
            gallery.innerHTML = '';
            
            for (let i = 1; i <= TOTAL; i++) {
                const card = document.createElement('div');
                card.className = 'card';
                
                // 序号标签（圆角）
                const indexSpan = document.createElement('span');
                indexSpan.className = 'index';
                indexSpan.textContent = i;
                card.appendChild(indexSpan);
                
                // 图片 - 使用 contain 保证完整显示
                const img = document.createElement('img');
                img.src = `images/${i}.jpg`;  // 从本地images文件夹读取
                img.alt = `安生-${i}`;
                img.loading = 'lazy';
                
                // 图片加载失败时的简单处理
                img.onerror = function() {
                    this.style.background = '#f0f0f0';
                    // 可以添加一个简单的文字提示，或者保持空白
                };
                
                card.appendChild(img);
                gallery.appendChild(card);
            }
            
            console.log(`已加载 ${TOTAL} 张本地图片，使用 contain 完整显示`);
        })();
    </script>
</body>
</html>