<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <script src="./tailwin.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> -->
    <script src="./jquery.js" ></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="./css/fa.css">
    <title>Memorize</title>
    <script>
        function alert(msg, type){
            let a;
            if(type == "error"){
                a = $(`<div class="notify notify_error">
                    <p class="fas fa-triangle-exclamation text-rose-400 p-1"></p>
                    <p class="border-l border-rose-400 text-rose-600 pl-2">${msg}</p>
                </div>`);
                
            }else{
                a = $(`<div class="notify notify_info">
                        <p class="fas fas fa-circle-exclamation text-green-400 p-1"></p>
                        <p class="border-l border-green-400 text-green-600 pl-2">${msg}</p>
                    </div>`);
            }
            $(".alert").append(a);
            setTimeout(()=>{
                a.animate({
                    opacity: 0
                }, 600);
                setTimeout(()=>{
                    a.remove();
                }, 600);
            }, 2000);
        }        
    </script>   
    <style type="text/tailwindcss">
        @layer components {
            .notify {
                @apply p-1 break-all border rounded-md flex flex-row items-center space-x-1 relative;
            }
            .notify_error{
                @apply bg-rose-200 border-rose-400;
            }
            .notify_info{
                @apply bg-green-200 border-green-400; 
            }
        }
    </style> 
</head>
<body class="relative font-sans overflow-x-hidden flex flex-col min-h-screen bg-gray-100 select-none">
    <div class="alert fixed right-2 bottom-2 flex flex-col w-60 p-2 space-y-2 z-20">
        
    </div>
    <?php session_start(); ?>
    <?php require_once("./antixss.php"); ?>
    <?php require_once("./Views/index.php"); ?>
    
</body>
</html>
