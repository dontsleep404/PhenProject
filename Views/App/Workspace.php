<div class="w-full p-3 space-y-3">
    <div class="w-full p-3 bg-white rounded-md flex items-center shadow-md">
        <p class="text-2xl"><span class="fas fa-folder-open text-indigo-400"></span> <?=$data["workspace"]["workspace"]->workspacename;?></p>
        <?php
            if($data["workspace"]["workspace"]->userid == $_SESSION["user"]["userid"]){
                $id = $data["workspace"]["workspace"]->workspaceid;
        ?>
        <div class="ml-auto p-2 space-x-2 flex">            
            <form class="flex" onsubmit="return(onsubmit_edit())" method="POST" action="?route=app&workspace=<?=$id;?>&action=edit">
                <input type="hidden" name="workspaceid" value="<?=$data["workspace"]["workspace"]->workspaceid;?>">
                <input id="workspacename" type="hidden" name="workspacename" value="<?=$data["workspace"]["workspace"]->workspacename;?>">
                <input type="submit" name="submit" id="submit_edit" value="">
                <label alt="delete" for="submit_edit" class="ml-auto bg-green-400 w-8 h-8 flex items-center justify-center text-white cursor-pointer rounded-md shadow-md">
                    <p class="fas fa-pen"></p>
                </label>
            </form>
            <form class="flex" onsubmit="return(onsubmit_delete())" method="POST" action="?route=app&workspace=<?=$id;?>&action=delete">
                <input type="hidden" name="workspaceid" value="<?=$data["workspace"]["workspace"]->workspaceid;?>">
                <input type="submit" name="submit" id="submit_delete" value="">
                <label alt="delete" for="submit_delete" class="ml-auto bg-rose-400 w-8 h-8 flex items-center justify-center text-white cursor-pointer rounded-md shadow-md">
                    <p class="fas fa-trash"></p>
                </label>
            </form>
        </div>
        <?php
            }
        ?>
    </div>

    <?php
        foreach($data["workspace"]["groups"] as $group => $array){
            $done = 0;
            foreach($array as $task){if($task->status == "true") $done++;}
    ?>
            <div class="border border-gray-200 rounded-md">
                <div class="toggle cursor-pointer font-medium">
                    <span class="fas fa-angle-right p-3"></span><?=$data["workspace"]["groupname"][$group];?> (<?=$done . "/" . count($array);?>)
                </div>
                <div class="show">
                    <table class="tasks w-full">
                        <colgroup>
                            <col span="1" class="w-3">
                        </colgroup>
                        <?php
                            foreach($array as $task){
                        ?>
                        <tr class="flex flex-row items-center odd:bg-gray-100">
                            <td>
                                <form action="?route=app&workspace=<?=$id;?>&action=toggleTask" method="post">
                                    <input type="hidden" name="itemid" value="<?=$task->itemid;?>">
                                    <input type="submit" name="submit" class="hidden" id="toggle_<?=$task->itemid;?>">
                                    <label for="toggle_<?=$task->itemid;?>">
                                        <p class="w-10 fas <?=($task->status == "true" ? "fas fa-circle-check" : "fa-circle-notch");?> p-3 cursor-pointer text-indigo-400"></p>
                                    </label>
                                </form>
                            </td>
                            <td class="flex-1 break-all"><?=$task->data;?> <?php if($task->deadline != null) {?><br><span class="text-gray-500 text-sm" > <?=date("d-m-Y H:i:s",$task->deadline);?><?php } ?></span></td>
                            <td>
                                <form action="?route=app&workspace=<?=$id;?>&action=deleteTask" method="post">
                                    <input type="hidden" name="itemid" value="<?=$task->itemid;?>">
                                    <input type="submit" name="submit" id="delete_task_<?=$task->itemid;?>" class="hidden">
                                    <label for="delete_task_<?=$task->itemid;?>"><p class="w-10 fas fa-trash p-3 cursor-pointer text-rose-400"></p></label>
                                </form>
                            </td>
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                    <form class="addtask flex items-center w-full" method="POST" action="?route=app&workspace=<?=$id;?>&action=addTask">
                        <input name="submit" type="submit" class="hidden" value="" id="submit_addTask_<?=$group;?>">
                        <input type="hidden" name="groupitemid" value="<?=$group;?>">
                        <input type="hidden" name="workspaceid" value="<?=$data["workspace"]["workspace"]->workspaceid;?>">
                        <label for="submit_addTask_<?=$group;?>">
                            <p class="w-10 fas fa-plus p-3 cursor-pointer text-green-400"></p>
                        </label><input name="task" class="w-60 p-1 outline-none border-b border-gray-200 flex-1" type="text" id="taskContent" placeholder="Add task">
                        <input type="datetime-local" name="deadline" id="datetime" class="picker w-0"><label for="datetime"><p class="fas fa-calendar-days p-4 text-indigo-400"></p></label>
                    </form>
                </div>
            </div>
    <?php
        }
    ?>

    <form class="bg-white shadow-md font-medium border border-green-100 rounded-md" method="POST" action="?route=app&workspace=<?=$id;?>&action=createGroup">
        <input type="submit" name="submit" class="hidden" value="" id="submit_addgroup">
        <label for="submit_addgroup"><span class="fas fa-plus p-3"></span></label>
        <input type="hidden" name="workspaceid" value="<?=$data["workspace"]["workspace"]->workspaceid;?>">
        <input class="outline-none p-1" type="text" name="groupitemname" placeholder="Add group" require>
    </form>
</div>
<script>
    $(".picker").focus(function(){
        $(this)[0].showPicker();
    });
    $(".toggle").click(function(){
        $($(this)[0].nextElementSibling).toggleClass("hidden");
    });
    function onsubmit_delete(e){        
        if(confirm("You will delete project <?=$data["workspace"]["workspace"]->workspacename;?>. You sure?")){
            return true;
        }else{
            return false;
        }
    }
    function onsubmit_edit(e){              
        if(confirm("Change project '<?=$data["workspace"]["workspace"]->workspacename;?>' name?")){
            document.querySelector("#workspacename").value = prompt("Name you want?");
            return true;
        }else{
            return false;
        }
    }
</script>