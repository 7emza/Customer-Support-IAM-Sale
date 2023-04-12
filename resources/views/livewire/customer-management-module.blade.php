<div>
    
    <div  class="flex mt-16">
        <div class="w-full lg:w-1/2 mx-2 border   shadow-xl rounded-md p-2 mt-2 ">
            <label for="details" class="block py-2">
                <h1 class="text-gray-700 text-2xl">post your issue </h1>
            </label>
            <hr > 
            
            <x-jet-input-error for="subject" class="mt-2 " />
            <input wire:model="subject" id="subject" class=" border rounded mt-2 m-2 p-2 block w-full " 
            placeholder="Subject">

            <x-jet-input-error for="details" class="mt-2 " />
                <textarea wire:model="details" id="details" class="form-textarea rounded mt-2 block w-full " rows="3"
                    placeholder="Describe your issue"></textarea>
            <button wire:click='submitted' class="bg-blue-800 hover:bg-gray-700 text-white px-4 py-2 mt-2 rounded ">
                Submit
            </button>
            <div wire:loading wire:target="submitted">
                sending your issue ...
            </div>

        </div>
        <div class="w-full lg:w-1/2 mx-2 border   shadow-xl rounded-md p-2 mt-2 ">
            
            <label class="py-2 flex items-center ">
                <h1 class="text-gray-700 text-2xl w-full">list recent issues  </h1>
                <div class="relative w-full flex items-center  ">
                    {{-- <label class="  absolute flex items-center   right-0  text-sm">
                        <input wire:model="showMain" type="checkbox" class="form-checkbox" checked>
                        <span class="ml-2">show only main</span>
                    </label> --}}
                </div>
            </label>
            <hr>
            <div class="py-2" style=" height: 50vh;overflow: auto; ">
                @foreach ($issues as $issue)
                <div class=" rounded-md    relative overflow-hidden  bg-gray-100   my-2 p-4 ">
                    <label class="p-2 flex items-center border-b-2 ">
                        <div class=" items-center w-full  ">
                            <div class="font-medium flex ">
                            Subject :{{$issue->subject}}
                            </div>
                            <div class="text-gray-600 text-sm">
                                Customer N°  / {{$issue->user->name}}
                            </div>
                        </div>
                        <div class="relative w-full flex items-center  ">
                            <label class="  absolute flex items-center   right-0  text-sm">
                                @if ($issue->user->id==auth()->user()->id && $issue->status!="Closed" )
                                    <a  href="javascript:void(0)" wire:click="toclose({{$issue->id}})" class="text-red-600 text-xs font-medium p-2 ">
                                        closed ?
                                    </a>
                                @endif
                                <div style="
                                    @if ($issue->status =='Closed') background:#d80611; 
                                    @elseif($issue->status =='In Progress')  background:#d8b106;
                                    @elseif($issue->status =='Resolved')  background:#0c7902;
                                    @else background:#0684d8;@endif
                                color:white;border-radius:17px;" class="px-2">
                                    {{$issue->status}}
                                </div>
                            </label>
                        </div>
                    </label>
                    <div class="p-2">
                        <div class="w-full">
                            <p class="text-gray-800 text-sm font-medium mb-2">
                                Working On:
                            </p>
                            <p class="text-gray-800 text-xl font-medium mb-2">
                                {{$issue->details}}
                            </p>
                        
                            
                        </div>
                        <div class="flex items-center justify-between my-2">
                            <p class="text-blue-600 text-xs font-medium mb-2">
                                created at: {{$issue->created_at}}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
      
       
    </div>
    <x-jet-dialog-modal wire:model="openToclosed" >
        <x-slot name="title">
        </x-slot>
        <x-slot name="content">
            <div class="-m-4 -my-6">
                Are you sure you want to close this issue?
            </div>
        </x-slot>
        <x-slot name="footer">
          
            <x-jet-button  wire:click="closed" class="bg-blue-800 hover:bg-blue-500 text-white px-4 py-2 mt-2 rounded ">
               yes i want 
            </x-jet-button>
            <x-jet-button  wire:click="$toggle('openToclosed')" wire:loading.attr="disabled"
            class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 mt-2 rounded ">
            Cancel    
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
