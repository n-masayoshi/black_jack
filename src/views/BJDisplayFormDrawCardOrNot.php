<?php

class BJDisplayFormDrawCardOrNot
{
    function displayFormDrawCardOrNot(): void
    {
        echo '
        <form method="POST">
            <button type="submit" name="choice" value="Y">Yes</button>
            <button type="submit" name="choice" value="N">No</button>
        </form>'
        ;

        # TODO: カードを1枚引く処理の関数を呼び出す。
        // session_start();を使って、1枚引き終わって、
        // 合計値が出たら session_destroy()でセッションを破棄する。
        // また、再度,session_start()して、1枚引くを行う？
    }
}
