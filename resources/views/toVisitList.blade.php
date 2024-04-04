@extends('layout.app')
@section('main')
<div class="flex justify-center">
    <div class="py-6 grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3" id="itineraireContainer">
    </div>
</div>
    <script>
        $(document).ready(function(){
            $.ajax({
                url: "http://127.0.0.1:8080/api/toVisit/list",
                method: "GET",
                headers: {'Authorization': localStorage.getItem('user_token')},
                success: function(data){
                    // console.log(data.list);
                    var itineraireContainer = $('#itineraireContainer');
                    data.list.forEach(function(item){
                        var itinerary = `
                            <div class="flex max-w-md mb-12 m-6 bg-white shadow-lg rounded-lg overflow-hidden">
                                <div class="w-1/3 bg-cover" style="background-image: url('${item.image_url}')"></div> 
                                <div class="w-2/3 p-4">
                                    <h1 class="text-gray-900 font-bold text-2xl titre">${item.titre}</h1>
                                    <p class="mt-2 text-gray-600 text-sm description">${item.description}</p>
                                    <div class="flex item-center mt-2">
                                        duree: ${item.duree}
                                    </div>
                                    <div class="flex item-center justify-between mt-3">
                                        <h1 class="text-gray-700 font-bold text-xl">${item.category_id}</h1>
                                        <button class="px-3 py-2 bg-gray-800 text-white text-xs font-bold uppercase rounded">Remove from visit list</button>
                                    </div>
                                </div>
                            </div>
                        `;
                        itineraireContainer.append(itinerary);
                    });
                },
                error: function(data){
                    console.log('Error:', data);
                }
            });
        });
    </script>
@endsection
