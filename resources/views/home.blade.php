@extends('layout.app')
@section('main')
<div class="flex justify-center">
    <div class="py-6 grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3" id="itineraireContainer">
        
    </div>
</div>
<script>
    $(document).ready(function () {
        $.ajax({
            url: "http://127.0.0.1:8080/api/itineraire/display",
            method: "GET",
            success: function (data) {
                var itineraireContainer = $('#itineraireContainer');
                data.itineraire.forEach(function (item) {
                    var destinationsHtml = '';
                    item.destination.forEach(function (dest) {
                        destinationsHtml += '<div>Destination: ' + dest.name + '</div> <div> Les endroits: ' + dest.toVisit + '</div> <div> Les plats:' + dest.plats + '</div> <div>Les activites: ' + dest.activities + '</div>';
                    });
                    var itinerary = `
                        <div class="flex mb-12 m-6 bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="w-1/3 bg-cover" style="background-image: url('${item.image}')"></div> 
                            <div class="w-2/3 p-4">
                                <h1 class="text-gray-900 font-bold text-2xl titre">${item.titre} ${item.id}</h1>
                                <p class="mt-2 text-gray-600 text-sm description">${item.description}</p>
                                <div class="flex item-center mt-2">
                                    Duration: ${item.duree}
                                </div>
                                <h1 class="text-gray-700 font-bold text-xl">${item.category.name}</h1>
                                <div class="flex item-center justify-between mt-6">
                                    <form class="toVisitList_Form">
                                        <input type="hidden" name="itineraire_id" value="${item.id}" required>
                                        <button type="submit" class="add-to-list">
                                            <span class="material-symbols-outlined">
                                                playlist_add
                                            </span>
                                        </button>
                                    </form>
                                    <form class="create_destination">
                                        <input type="hidden" class="itineraire_id" value="${item.id}" required>
                                        <button type="submit">
                                            <span class="material-symbols-outlined">
                                                add_location_alt
                                            </span>
                                        </button>
                                    </form>
                                    <form class="update_itinerary">
                                        <input type="hidden" class="itineraire_id" value="${item.id}" required>
                                        <button type="submit">
                                            <span class="material-symbols-outlined">
                                                edit
                                            </span>  
                                        </button>
                                    </form>
                                    <div x-data="{ open : false }">
                                        <a href="#" @click="open = true">
                                            <button type="submit">
                                                <span class="material-symbols-outlined">
                                                    read_more
                                                </span>
                                            </button>
                                        </a>
                                        @include('components.display_details')
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    itineraireContainer.append(itinerary);
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

        $(document).on('click', '.create_destination', function (event) {
            event.preventDefault();
            var itineraryId = $(this).find('.itineraire_id').val();
            window.open('/destination/create/' + itineraryId, '_self');
        });
        $(document).on('click', '.update_itinerary', function(event){
            event.preventDefault();
            var itineraryId = $(this).find('.itineraire_id').val();
            window.open('/itineraires/update/' + itineraryId, '_self');
        });
    });
</script>
@endsection
