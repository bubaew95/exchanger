<?php

namespace App\Service\TelegramNotifier;

enum EnumParseMode: string
{
    case PARSE_MODE_HTML = 'HTML';
    case PARSE_MODE_MARKDOWN = 'Markdown';
    case PARSE_MODE_MARKDOWN_V2 = 'MarkdownV2';
}
