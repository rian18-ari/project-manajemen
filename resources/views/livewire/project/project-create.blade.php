@section('title', 'Project Create')
<div>
    <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg border-2 border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Recent Project Activity</h2>
        </div>
        <form wire:submit.prevent="store">
            <div>
                <label for="">Project Name</label>
                <input type="text" wire:model="title" id="" placeholder="Enter Project Name"
                    class="block w-full border-2 border-gray-400 rounded-lg p-2">
            </div>
            <div>
                <label for="">Project Description</label>
                <textarea wire:model="description" id="" placeholder="Enter Project Description"
                    class="block w-full border-2 border-gray-400 rounded-lg p-2"></textarea>
            </div>
            <div>
                <label for="">Project Color</label>
                <select type="color" wire:model="color" id="" placeholder="Enter Project Color"
                    class="block w-full border-2 border-gray-400 rounded-lg p-2">
                    <option value=""><span class="w-2 h-2 rounded-full inline-block mr-2"
                            style="background-color: #A2D9CE;"></span>--select bg color--</option>
                    <option value="#A2D9CE"><span class="w-2 h-2 rounded-full inline-block mr-2"
                            style="background-color: #A2D9CE;"></span>biru muda langit</option>
                    <option value="#BDECB6"><span class="w-2 h-2 rounded-full inline-block mr-2"
                            style="background-color: #BDECB6;"></span>mint hijau pucat</option>
                    <option value="#F5B7B1"><span class="w-2 h-2 rounded-full inline-block mr-2"
                            style="background-color: #F5B7B1;"></span>pink merah pucat</option>
                    <option value="#F7DC6F"><span class="w-2 h-2 rounded-full inline-block mr-2"
                            style="background-color: #F7DC6F;"></span>kuning lemon pucat</option>
                    <option value="#D2B4DE"><span class="w-2 h-2 rounded-full inline-block mr-2"
                            style="background-color: #D2B4DE;"></span>biru muda pucat</option>
                    <option value="#FADBD8"><span class="w-2 h-2 rounded-full inline-block mr-2"
                            style="background-color: #FADBD8;"></span>lavender pucat</option>
                    <option value="#AAB7B8"><span class="w-2 h-2 rounded-full inline-block mr-2"
                            style="background-color: #AAB7B8;"></span>biru muda pucat</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="">Project Start Date</label>
                    <input type="date" wire:model="start_date" id=""
                        class="block w-full border-2 border-gray-400 rounded-lg p-2">
                </div>
                <div>
                    <label for="">Project End Date</label>
                    <input type="date" wire:model="end_date" id=""
                        class="block w-full border-2 border-gray-400 rounded-lg p-2">
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-lg">Add Project</button>
            </div>
        </form>
    </div>
</div>
