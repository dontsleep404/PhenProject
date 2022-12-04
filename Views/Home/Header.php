<div class="hidden bkg bg-opacity-30 bg-black w-screen h-screen fixed top-0 left-0 backdrop-blur-sm"></div>
<div>    
    <div class="py-3 px-3 md:px-24 flex flex-row items-center relative z-10 bg-white">
        <?php require("Views/Logo/Logo.php") ?>
        <div class="toggle md:hidden ml-auto fas fa-bars text-2xl text-indigo-400 cursor-pointer"></div>        
        <ul class="hidden ml-auto md:flex flex-row items-center space-x-3 font-medium text-xl">
            <a href="#home" class="hover:text-indigo-500 p-1">Home</a>
            <a href="#about" class="hover:text-indigo-500 p-1">About</a>
            <a href="#service" class="hover:text-indigo-500 p-1">Service</a>
            <a href="#contact" class="hover:text-indigo-500 p-1">Contact</a>
            <a href="?route=login" class="px-3 py-1 bg-indigo-400 rounded-md text-white cursor-pointer hover:bg-indigo-500">Login</a>
        </ul>    
        <div class="hidden w-80 h-max bottom-0 translate-y-full right-0 absolute menu overflow-hidden transition-all duration-300 bg-white rounded-b-md">
            <ul class="md:hidden ml-auto flex flex-col space-y-2 items-center font-medium text-xl p-3 text-center">
                <a href="?route=home" class="px-3 py-1 hover:text-white hover:bg-indigo-300 w-full rounded-md cursor-pointer">Home</a>
                <a href="?route=home" class="px-3 py-1 hover:text-white hover:bg-indigo-300 w-full rounded-md cursor-pointer">About</a>
                <a href="?route=home" class="px-3 py-1 hover:text-white hover:bg-indigo-300 w-full rounded-md cursor-pointer">Service</a>
                <a href="?route=home" class="px-3 py-1 hover:text-white hover:bg-indigo-300 w-full rounded-md cursor-pointer">Contact</a>
                <a href="?route=login" class="px-3 py-1 w-full bg-indigo-400 rounded-md text-white cursor-pointer hover:bg-indigo-500">Login</a>
            </ul>
        </div>
    </div>        
</div>
<script>
    let toggle = $(".toggle");
    let menu = $(".menu");
    let bkg = $(".bkg");
    toggle.click(()=>{
        menu.toggleClass("hidden");
        bkg.toggleClass("hidden");
    });
</script>