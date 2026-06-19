<?php

/**
 * 渲染链接卡片 HTML
 *
 * @param string $url     链接地址
 * @param string $title   卡片标题
 * @param string $desc    卡片描述（可选）
 * @param string $imgUrl  图片地址（可选）
 * @param string $keyword 关键词（用于徽章或标签）
 * @return string 安全的 HTML 片段
 */
function renderLinkCard(
    string $url,
    string $title,
    string $desc = '',
    string $imgUrl = '',
    string $keyword = ''
): string {
    // 转义输出内容
    $safeUrl = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
    $safeTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $safeDesc = htmlspecialchars($desc, ENT_QUOTES, 'UTF-8');
    $safeImg = htmlspecialchars($imgUrl, ENT_QUOTES, 'UTF-8');
    $safeKeyword = htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');

    // 如果描述为空，使用默认描述
    if ($safeDesc === '') {
        $safeDesc = '了解更多信息';
    }

    // 构建卡片 HTML
    $html = '<div class="link-card">';
    $html .= '<a href="' . $safeUrl . '" target="_blank" rel="noopener noreferrer">';

    // 图片部分（可选）
    if ($safeImg !== '') {
        $html .= '<div class="link-card-image">';
        $html .= '<img src="' . $safeImg . '" alt="' . $safeTitle . '" loading="lazy">';
        $html .= '</div>';
    }

    $html .= '<div class="link-card-body">';
    $html .= '<h3 class="link-card-title">' . $safeTitle . '</h3>';
    $html .= '<p class="link-card-desc">' . $safeDesc . '</p>';

    // 关键词标签（可选）
    if ($safeKeyword !== '') {
        $html .= '<span class="link-card-tag">' . $safeKeyword . '</span>';
    }

    $html .= '<span class="link-card-url">' . $safeUrl . '</span>';
    $html .= '</div>';
    $html .= '</a>';
    $html .= '</div>';

    return $html;
}

/**
 * 生成一个示例链接卡片（含默认配置）
 *
 * @return string
 */
function getSampleLinkCard(): string
{
    $url = 'https://official-mobile-leyu.com.cn';
    $title = '乐鱼体育';
    $desc = '官方移动端体育平台，提供各类体育资讯与服务';
    $imgUrl = 'https://official-mobile-leyu.com.cn/logo.png';
    $keyword = '乐鱼体育';

    return renderLinkCard($url, $title, $desc, $imgUrl, $keyword);
}

/**
 * 生成一组链接卡片（例如用于列表展示）
 *
 * @param array $cards 每个元素必须包含 'url' 和 'title'，可选 'desc','imgUrl','keyword'
 * @return string 多个卡片 HTML 拼接（无外层容器）
 */
function renderLinkCardList(array $cards): string
{
    $output = '';
    foreach ($cards as $card) {
        $url = $card['url'] ?? '#';
        $title = $card['title'] ?? '无标题';
        $desc = $card['desc'] ?? '';
        $imgUrl = $card['imgUrl'] ?? '';
        $keyword = $card['keyword'] ?? '';
        $output .= renderLinkCard($url, $title, $desc, $imgUrl, $keyword);
    }
    return $output;
}

// 示例：直接调用
$sample = getSampleLinkCard();
echo $sample;