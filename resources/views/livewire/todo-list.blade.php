<div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900">

                    <form wire:submit="createTodo">
                        <!-- Todo text -->
                        <div class="mb-2">
                            <x-text-input wire:model="todo_text" id="todo_text" class="block mt-1 w-full" type="text"
                                name="todo_text" :value="old('todo_text')" required autofocus placeholder="Add new todo" />
                            <x-input-error :messages="$errors->get('todo_text')" class="mt-2" />
                        </div>

                        <div class="mb-2">
                            <select wire:model="todo_category"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="normal">{{ __('Normal') }}</option>
                                <option value="personal">{{ __('Personal') }}</option>
                                <option value="work">{{ __('Work') }}</option>
                            </select>
                        </div>

                        <div>
                            <x-primary-button>
                                <i class="fas fa-plus"></i>
                            </x-primary-button>
                        </div>
                    </form>

                    <div class="flex justify-between items-center">
                        <div class="mt-2">
                            <span wire:click="setFilter('status','all')"
                                class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 cursor-pointer">
                                ({{ $todosCount }}) {{ __('All') }}
                            </span>

                            <span wire:click="setFilter('status','completed')"
                                class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 cursor-pointer">

                                ({{ $completedTodosCount }}) {{ __('Completed') }}
                            </span>

                            <span wire:click="setFilter('status','in_progress')"
                                class="inline-flex items-center rounded-md bg-pink-50 px-2 py-1 text-xs font-medium text-pink-700 ring-1 ring-inset ring-pink-700/10 cursor-pointer">

                                ({{ $inProgressTodosCount }}) {{ __('In Progress') }}
                            </span>
                        </div>

                        <div>
                            <span wire:click="resetFilter()"
                                class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 cursor-pointer">
                                {{ __('Reset') }}
                            </span>
                        </div>
                    </div>

                    {{-- Todo List --}}
                    <ul class="todo-list mt-3">
                        @foreach ($todos as $todo)
                            @if ($updateMode == $todo->id)
                                <form wire:submit="updateTodo({{ $todo->id }})" class="mb-2 flex gap-2">
                                    <!-- Todo text -->
                                    <div class="flex-1">
                                        <x-text-input wire:model="todo_text_update" id="todo_text_update"
                                            class="block mt-1 w-full" type="text" name="todo_text_update"
                                            :value="old('todo_text_update')" required autofocus placeholder="Add new todo" />
                                        <x-input-error :messages="$errors->get('todo_text_update')" class="mt-2" />
                                    </div>

                                    <div>
                                        <select wire:model="todo_category_update"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="normal">{{ __('Normal') }}</option>
                                            <option value="personal">{{ __('Personal') }}</option>
                                            <option value="work">{{ __('Work') }}</option>
                                        </select>
                                    </div>
                                </form>
                            @else
                                <li class="flex items-center gap-2 mb-2">
                                    <span wire:click="changeCompletedStatus({{ $todo->id }})"
                                        class="todo-item-done border-slate-30 border-solid border rounded-full w-7 h-7 cursor-pointer flex items-center justify-center">

                                        @if ($todo->completed)
                                            <i class="fas fa-check "></i>
                                        @endif

                                    </span>
                                    <span
                                        class="todo-item-text todo-item rounded-md bg-gray-50 p-2 block flex-1  {{ $todo->completed ? 'line-through' : '' }}">
                                        {{ $todo->todo_text }}

                                        @if ($todo->category)
                                            <span class="block">
                                                <span wire:click="setFilter('category','{{ $todo->category }}')"
                                                    class="inline-flex items-center rounded-md bg-gray-50 px-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 cursor-pointer">
                                                    {{ $todo->category }}
                                                </span>
                                            </span>
                                        @endif
                                    </span>

                                    <x-danger-button wire:click="deleteTodo({{ $todo->id }})">
                                        <i class="far fa-trash-alt"></i>
                                    </x-danger-button>

                                    <x-primary-button wire:click="updateTodoMode({{ $todo->id }})">
                                        <i class="fas fa-pencil-alt"></i>
                                    </x-primary-button>


                                </li>
                            @endif
                        @endforeach
                    </ul>

                    <div>
                        {{ $todos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
