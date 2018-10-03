<table class="panel" width="100%" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; margin: 0 0 21px;">
        <tr>
            <td class="panel-content" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #edeff2; padding: 16px;">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="panel-item">
                            {{ Illuminate\Mail\Markdown::parse($slot) }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
</table>