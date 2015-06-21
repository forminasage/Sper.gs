{include file="header.tpl"}
            <h1>Related Images for {if isset($sha1_sum)}<a href="{$base_url}/img.php?hash={$sha1_sum}">{$filename}</a>{else}User: <a href="{$base_url}/profile.php?user={$user_id}">{$username}{/if}</h1>
            <!--<center>(<a href="/imagemap.php?md5=cd73844a9667f34f82628faf81b0cc0b">go to topic view</a>)</center>-->
            <br/>
            <div class="infobar">Page 1 of <span>1</span><!--<span> | <a>Next Page</a></span><span> | <a>Last Page</a></span>--></div>
            {if $images != false}<div class="image_grid">
            {foreach from=$images key=header item=img}
                <div class="grid_block">
                    <a href="{$base_url}/img.php?hash={$img.sha1_sum}"><img src="./usercontent/i/t/{$img.sha1_sum}/{$img.filename_url}.jpg" /></a><br/>
                    <div class="block_desc">
                        <a style="float: left;" href="{$base_url}/img.php?hash={$img.sha1_sum}">{$img.filename}</a>
                        <div style="float: right;"><a href="{$base_url}/imagemap.php?hash={$img.sha1_sum}">topics</a> | <a href="{$base_url}/imagemap.php?hash={$img.sha1_sum}">related</a></div>
                        <br/><br/><a href="{$base_url}/showmessages.php?topic={$img.topic_id}">{$img.title}</a> <span style="float: right;">(<a href="{$base_url}/imagemap.php?topic={$img.topic_id}">images</a>)</span>
                    </div>
                </div>
            {/foreach}
            </div>{/if}
            <div style="clear: left;"><br/></div>
            </table>
            <div class="infobar">Page: 1</div>
            <br /><br />{include file="footer.tpl"}
        </div>
    </body>
</html>
