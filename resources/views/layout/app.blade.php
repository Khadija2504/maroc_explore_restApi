<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        span{
            color: red;
        }
    </style>
</head>
<body>
    <nav id="header" class="w-full z-30 top-10 py-1 bg-white shadow-lg border-b border-blue-400">
        <div class="w-full flex items-center justify-between mt-0 px-6 py-2">
           <label for="menu-toggle" class="cursor-pointer md:hidden block">
              <svg class="fill-current text-blue-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                 <title>menu</title>
                 <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
              </svg>
           </label>
           <input class="hidden" type="checkbox" id="menu-toggle">
           
           <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
              <nav>
                
                 <ul class="md:flex items-center justify-between text-base text-blue-600 pt-4 md:pt-0">
                    <li><a class="inline-block no-underline hover:text-black font-medium text-lg py-2 px-4 lg:-ml-2" href="#">Home</a></li>
                    <li><a class="inline-block no-underline hover:text-black font-medium text-lg py-2 px-4 lg:-ml-2" href="#">Products</a></li>
                    <li><a class="inline-block no-underline hover:text-black font-medium text-lg py-2 px-4 lg:-ml-2" href="#">About</a></li>
                 </ul>
              </nav>
           </div>

           <div class="order-2 md:order-3 flex flex-wrap items-center justify-end mr-0 md:mr-4" id="nav-content">
              <div class="auth flex items-center w-full md:w-full">
                <form id="searchForm">
                <div class="flex items-center max-w-md mx-auto bg-white rounded-lg mr-20 border-solid border-2 border-blue-400" x-data="{ search: '' }">
                    <div class="w-full">
                        <input id="searchInput" name="search" type="text" class="w-full px-4 py-1 text-gray-800 rounded-full focus:outline-none"
                            placeholder="search" x-model="search">
                    </div>
                    <div>
                        <button type="submit" class="flex items-center bg-blue-500 justify-center w-12 h-12 text-white rounded-r-lg"
                            :class=" 'bg-purple-500' : 'bg-gray-500 cursor-not-allowed'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                </form>
                {{-- <ul id="result"></ul> --}}
                <button class="logout bg-transparent text-gray-800 p-2 rounded border border-gray-300 mr-4 hover:bg-gray-100 hover:text-gray-700">Logout</button>
                <a href="/login" class="login_btn"><button class="login_btn bg-transparent text-gray-800 p-2 rounded border border-gray-300 mr-4 hover:bg-gray-100 hover:text-gray-700">Sign in</button></a>
                <a href="/register" class="register_btn"><button class="register_btn bg-blue-600 text-gray-200 p-2 rounded  hover:bg-blue-500 hover:text-gray-100">Sign up</button></a>
              </div>
           </div>
        </div>
     </nav>
     {{-- <div class=" w-full flex justify-center">
        <div @click.away="openSort = false" class="relative" x-data="{ openSort: true,sortType:'Sort by' }">
            <button @click="openSort = !openSort" class="flex  text-white bg-gray-200 items-center justify-start w-40  py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg ">
                <span x-text="sortType"></span>
                <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': openSort, 'rotate-0': !openSort}" class="w-4 h-4  transition-transform duration-200 transform "><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              </button>
          <div x-show="openSort" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute z-50 w-full  origin-top-right">
            <div class="px-2 pt-2 pb-2 bg-white rounded-md shadow-lg dark-mode:bg-gray-700">
              <div class="flex flex-col">
                <a @click="sortType='Most disscussed',openSort=!openSort" x-show="sortType != 'Most disscussed'" class="flex flex-row items-start rounded-lg bg-transparent p-2 hover:bg-gray-200 " href="#">
                  
                  <div class="">
                    <p class="font-semibold">Most disscussed</p>
                  </div>
                </a>

                <a @click="sortType='Most popular',openSort=!openSort" x-show="sortType != 'Most popular'" class="flex flex-row items-start rounded-lg bg-transparent p-2 hover:bg-gray-200 " href="#">
                  
                  <div class="">
                    <p class="font-semibold">Most popular</p>
                  </div>
                </a>

                <a @click="sortType='Most upvoted',openSort=!openSort" x-show="sortType != 'Most upvoted'" class="flex flex-row items-start rounded-lg bg-transparent p-2 hover:bg-gray-200 " href="#">
                  
                  <div class="">
                    <p class="font-semibold">Most upvoted</p>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div> 
    </div> --}}
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
     <div id="result" class="w-4/6 z-50 absolut mx-auto mt-7 flex item-center justify-between mt-3"></div>
    @yield('main')
    <script>
        var token = localStorage.getItem('user_token');
        
        if(window.location.pathname == '/login' || window.location.pathname == '/register'){
            if(token != null){
                window.open('/home', '_self');
            }
            
            $("#header").hide();
        } else if(window.location.pathname == '/home'){
            if(token != null){
                $(".login_btn").hide();
                $(".register_btn").hide();
            } else{
                $(".logout").hide();
            }
        }
        else{
            if(token == null){
                window.open('/login', '_self');
            } else{
                $(".login_btn").hide();
                $(".register_btn").hide();
            }
        }
        $(document).ready(function(){
            $(".logout").click(function(){
                $.ajax({
                    url: 'http://127.0.0.1:8080/api/logout',
                    type: "GET",
                    headers: {'Authorization': localStorage.getItem('user_token')},
                    success: function(data){
                        if(data.seccess == true){
                            localStorage.removeItem('user_token');
                            window.open('/login', '_self');
                        } else{
                            alert(data.msg);
                        }
                    }
                });
            });
        });
        $(document).ready(function(){
            $("#searchForm").submit(function(event){
                event.preventDefault();
                var formData = $(this).serialize();
                var resultItineraries = $("#result");
                resultItineraries.empty();
                $.ajax({
                    url: "http://127.0.0.1:8080/api/itineraire/search",
                    method: "POST",
                    data: formData,
                    success: function(data){
                        // console.log(data);
                        data.itineraire.forEach(function(item) {
                            var itinerary = `
                                <div class="w-full flex p-3 pl-4 items-center hover:bg-gray-300 rounded-lg cursor-pointer">
                                <div class="mr-4">
                                    <div class="h-9 w-9 rounded-sm flex items-center justify-center text-3xl" >
                                    </div>
                                </div>
                                <div>
                                    <div class="font-bold text-lg">${item.titre}</div>
                                    <div class="text-xs text-gray-500">
                                        <div class="mr-2">${item.duree} days</div>
                                        <div class="mr-2">${item.category.name}</div>
                                        <div class="mr-2">create by ${item.users.name}</div>
                                    </div>
                                </div>
                                <button class="px-3 py-2 bg-gray-800 text-white text-xs font-bold uppercase rounded" id"listForm">Add to visit list</button>
                            `;
                            resultItineraries.append(itinerary);
                        });
                    },
                });
            });
            function printErrorMsg(msg){
                $(".error").text("");
                $.each(msg, function(key, value){
                    $("."+key+"_err").text(value);
                });
            }
        });
        
    </script>
