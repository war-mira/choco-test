<tr>
    <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; background-color: #02a0f2;">
        <table class="footer" align="center" width="760" cellpadding="0" cellspacing="0" style="margin: 0 auto; padding: 0; text-align: center; width: 760px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 760px;">
            <tr>
                <td class="content-cell" align="center" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; padding: 35px;color: #ffffff;">
                    {{ Illuminate\Mail\Markdown::parse($slot) }}
                </td>
            </tr>
        </table>
    </td>
</tr>