<div class="w-screen h-screen flex flex-col p-2 space-y-2 max-h-screen">
    <div class="rounded-md p-3 px-3 shadow-md bg-white flex flex-row items-center">
        <?php require("Views/Logo/Logo.php") ?>
        <div class="side_toggle fas fa-bars ml-auto text-2xl p-1 cursor-pointer hover:text-indigo-400"></div>
    </div>
    <div class="flex-1 min-h-0 flex flex-row md:space-x-2 relative">
        <div class="side -left-72 md:left-0 absolute h-full md:relative bg-white shadow-lg overflow-y-auto rounded-md p-3 w-64 text-md space-y-3 flex flex-col transition-all duration-[2000]">
            <div class="flex-1 space-y-1 flex flex-col">
                <form action="?route=app&action=create" method="POST" class="sidebar_item">
                    <button name="submit" type="submit" class="w-10 h-10 flex items-center justify-center">
                        <p class="fas fa-plus"></p>
                    </button>     
                    <input type="text" placeholder="Create project" name="workspacename" id="" class="placeholder:text-gray-200 border-b border-gray-400 w-36 p-1 ml-3 bg-transparent border-0 outline-none">
                                       
                </form>
                <div class="w-full h-[2px] bg-gray-300"></div>
                <?php
                foreach($data["workspaces"] as $workspace){
                    ?>
                    <a href="?route=app&workspace=<?=$workspace->workspaceid;?>" class="sidebar_item hover:shadow-lg hover:translate-x-1">
                        <div class="w-10 h-10 flex items-center justify-center">
                            <p class="fas fa-folder"></p>
                        </div>
                        <p class="ml-3 flex-1 overflow-hidden"><?=$workspace->workspacename;?></p>
                    </a>
                <?php
                }
                ?>
            </div>
            <div class="flex flex-col">
                <a href="?route=login&action=logout" class="sidebar_item mt-auto bg-indigo-400 text-white">
                    <div class="w-10 h-10 flex items-center justify-center">
                        <p class="fas fa-power-off"></p>
                    </div>        
                    <p class="ml-3">Logout</p>
                </a>
            </div>
        </div>
        <div class="flex-1 rounded-md bg-white shadow-md overflow-y-auto">
            <?php require_once("Views/App/app.php"); ?>
        </div>
    </div>
</div>
<style type="text/tailwindcss">
    @layer components {
        .sidebar_item {
            @apply w-full flex items-center p-1 rounded-md bg-indigo-500 text-white hover:bg-indigo-400 shadow-md transition-all duration-150 cursor-pointer;
        }
    }
</style>
<script>
    let toggle = $(".side_toggle");
    let side = $(".side");
    toggle.click(()=>{
        side.toggleClass("left-0");
    })
</script>