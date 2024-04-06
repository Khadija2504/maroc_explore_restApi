<div x-show="open" class="fixed z-10 flex justify-center inset-0 overflow-y-auto" x-cloak style="background-color: #6970ff50;">
    <div class="bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg duration-500" style="width: 50%; height: fit-content">
        <div class="flex flex-wrap items-center">
            <button @click="open = false" style="margin-right: 10px;">
                <span class="material-symbols-outlined">
                    close
                </span>
            </button>
            <h3 class="mb-3 text-xl font-bold text-indigo-600">${item.titre}</h3>
        </div>
        <div class="flex mb-12 m-6 bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="w-1/3 bg-cover" style="background-image: url('')"></div> 
            <div class="w-2/3 p-4">
                <p class="mt-2 text-gray-600 text-sm description">${item.description}</p>
                <div class="flex item-center mt-2">
                    Duration: ${item.duree}
                </div>
                <div class="flex item-center justify-between mt-3">
                    <h1 class="text-gray-700 font-bold text-xl">${item.category.name}</h1>
                    <form class="toVisitList_Form">
                        <input type="hidden" name="itineraire_id" value="${item.id}" required>
                        <button type="submit" class="px-3 py-2 bg-gray-800 text-white text-xs font-bold uppercase rounded add-to-list">Add to visit list</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="destinations">
            ${destinationsHtml}
        </div>
    </div>
</div>