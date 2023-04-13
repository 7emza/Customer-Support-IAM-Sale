<div>

    <div class="py-2 items-center   overflow-x-hidden  " style="vh; z-index:-10">
        <div class="max-w-7xl mx-auto px-2">
            <div class="  my-2">
                <div class="mt-1 relative rounded-md shadow-sm">
                    <input id="search" onkeyup="myFunction()" type="text" name="search"
                        placeholder="Search any thing ..."
                        class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-5 pr-12 sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
            <div class="p-5"></div>

            <div class="   border-b border-gray-200 sm:rounded-lg  overflow-x-hidden " style="height: 56vh;">

                <div class="w-full overflow-x-auto">
                    <table id="myTable" class="w-full table-fixed">
                        <thead class="sticky">
                            <tr
                                class="text-md  sticky tracking-wide  text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class=" border text-center ">Subject</th>
                                <th class=" border text-center  ">details</th>
                                <th class=" border text-center ">Status</th>
                                <th class=" border text-center ">date</th>
                                <th class=" border text-center ">controls</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white ">
                            @isset($issues)
                                @forelse ($issues as $key => $issue)
                                    <tr class="text-gray-700">
                                        <td class=" p-2 border">
                                            <div class=" w-60 flex items-center text-sm">
                                                <div>
                                                    <p class=" text-black">{{ $issue->subject }}</p>
                                                    <p class="text-xs text-gray-600">{{ $issue->user->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class=" p-2 w-60 text-ms  border">{{ $issue->details }}</td>
                                        <td class=" p-2 w-24 text-xs border">
                                            <span style="
                                                @if ($issue->status =='Closed') background:#d80611;
                                                @elseif($issue->status =='In Progress')  background:#d8b106;
                                                @elseif($issue->status =='Resolved')  background:#0c7902;
                                                @else background:#0684d8;@endif
                                            color:white;border-radius:17px;" class="px-2">
                                                {{$issue->status}}
                                        </span>
                                        </td>
                                        <td class=" text-xs border w-20">
                                            {{ Carbon\Carbon::parse($issue->created_at)->format('M m, Y') }}
                                        </td>
                                        <td class=" p-2  w-24 border text-center">
                                            <a href="javascript:void(0)" wire:click="display({{ $issue->id }})"
                                                class="text-blue-600 ">
                                                display
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                 @endforelse
                            @endisset
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>


    {{-- Add section to sys admin to adding another admins --}}
    {{-- not asked --}}
    @role('sys-admin')
    <br><br>
    <br><br>
    <br><br>
    <hr>
    <div class="py-6">
        <h1 style="color: royalblue" >Add new admins</h1>
        <x-jet-input-error for="adminname" class="mt-2 " />
        <input wire:model="adminname" id="adminname" class=" border rounded mt-2 m-2 p-2 block w-full "
        placeholder="admin name">

        <x-jet-input-error for="adminemail" class="mt-2 " />
        <input wire:model="adminemail" id="adminemail" class=" border rounded mt-2 m-2 p-2 block w-full "
        placeholder="admin email">

        <x-jet-input-error for="adminpassword" class="mt-2 " />
        <input type="password" wire:model="adminpassword" id="adminpassword" class=" border rounded mt-2 m-2 p-2 block w-full "
        placeholder="password">

        <button wire:click='addadmin' class="bg-blue-800 hover:bg-gray-700 text-white px-4 py-2 mt-2 rounded ">
            create
        </button>
        <div wire:loading wire:target="addadmin">
            creating new admin ...
        </div>
    </div>
    @endrole

    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {

                td = tr[i].getElementsByTagName("td");
                if (td[0] || td[1] || td[2] || td[3] || td[4]) {
                    txtValue = td[0].textContent || td[0].innerText;
                    txtValue += td[1].textContent || td[1].innerText;
                    txtValue += td[2].textContent || td[2].innerText;
                    txtValue += td[3].textContent || td[3].innerText;
                    txtValue += td[4].textContent || td[4].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }

            }
        }
    </script>
    <x-jet-dialog-modal wire:model="isdispaly">
        <x-slot name="title">
        </x-slot>
        <x-slot name="content">
            <div class="-m-4 -my-6">

                <label for="details" class="block py-2">
                    <h1 class="text-gray-700 text-2xl">menage this issue </h1>
                    @isset($issue)

                    created_at {{ Carbon\Carbon::parse($issue->created_at)->format('M m, Y') }}
                    @endisset

                </label>
                    <hr>
                    <p id="subject" class="form-textarea rounded mt-2 block w-full " rows="3"
                        placeholder="Describe your issue">
                        <b>subject</b>  : <br> {{$subject}}
                    </p>
                    <p id="details" class="form-textarea rounded mt-2 block w-full " rows="3"
                    placeholder="Describe your issue">
                    <b>Details issue</b>  : <br> {{$details}}
                </p>

                <hr>
                <b>Response</b>
                <br>

                <select name="" wire:model="status" id="">
                    <option value="Submitted">Submitted</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Resolved">Resolved</option>
                    <option value="Closed">Closed</option>
                    <option value="Delete">Delete</option>
                </select>
                <br>
                message
                <textarea wire:model="message" id="message" class="form-textarea rounded mt-2 block w-full " rows="3"
                    placeholder="message to the customer">
                </textarea>

                    <br>
                    <br>


            </div>
        </x-slot>
        <x-slot name="footer">
            <div wire:loading wire:target="apply">
                applying ...
            </div>
            <x-jet-button wire:click="apply" class="bg-blue-800 hover:bg-blue-500 text-white px-4 py-2 mt-2 rounded ">
                apply
            </x-jet-button>
            <x-jet-button wire:click="$toggle('isdispaly')" wire:loading.attr="disabled"
                class="bg-gray-800 hover:bg-gray-700 text-white px-4 py-2 mt-2 rounded ">
                Cancel
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
