<div class="p-2 w-screen flex justify-center items-center flex-1">
    <form method="POST" action="?route=login&action=register" class="w-full max-w-lg bg-white shadow-sm p-5 rounded-lg">       
        <center>
            <?php require("./Views/Logo/Logo.php"); ?>
        </center> 
        <center class="text-4xl font-medium my-4">
            Register
        </center>
        <p class="text-xl mb-2 font-medium">Email</p>
        <input type="text" name="email" class="w-full outline-2 outline-indigo-300 text-xl p-3 mb-4 rounded-lg border border-gray-300" required>
        <p class="text-xl mb-2 font-medium">Username</p>
        <input type="text" name="username" class="w-full outline-2 outline-indigo-300 text-xl p-3 mb-4 rounded-lg border border-gray-300" required>
        <p class="text-xl mb-2 font-medium">Password</p>
        <input type="password" name="password" class="w-full outline-2 outline-indigo-300 text-xl p-3 mb-4 rounded-lg border border-gray-300" required>
        <p class="text-xl mb-2 font-medium">Confirm Password</p>
        <input type="password" name="repassword" class="w-full outline-2 outline-indigo-300 text-xl p-3 mb-4 rounded-lg border border-gray-300" required>
        <hr class="mb-2">
        <input type="submit" name="submit" value="Register" class="w-full cursor-pointer bg-indigo-400 hover:bg-indigo-500 text-white text-xl font-medium p-3 rounded-lg">
        <hr class="mb-2">
        <center>
            Have an account? <a class="text-2sm text-indigo-400" href="?route=login">Login</a>
        </center>
    </form>
</div>