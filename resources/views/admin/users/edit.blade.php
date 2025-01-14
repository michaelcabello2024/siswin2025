<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 flex items-center space-x-2">
            <!-- Enlace a la lista de usuarios -->
            <a href="{{ route('admin.users.index') }}" class="text-blue-600 no-underline flex items-center space-x-1">
                <!-- Ícono de usuarios -->
                <i class="fas fa-users"></i>
                <span>{{ __('List Users') }}</span>
            </a>
            <!-- Separador -->
            <span class="text-gray-500">/</span>
            <!-- Página actual -->
            <span class="text-gray-800">{{ __('User Edit') }}</span>
        </h2>

    </x-slot>

    <div class="grid grid-cols-1 px-4 mx-auto mt-4 sm:px-6 lg:px-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-x-6 gap-y-8">

        <form method="POST" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="px-3 bg-white">

                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div>

                            <h3 class="text-center profile-username">Datos del Usuario</h3>


                            {{--  @include('partials.error-messages') --}}

                            <div class="mb-4">
                                <x-label value="Nombre:" />
                                <x-input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    placeholder="tu  nombre" class="w-full" />
                                <x-input-error for="name" />
                            </div>

                            <div class="mb-4">
                                <x-label value="Email:" />
                                <x-input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    placeholder="ingrese tu Email" class="w-full" />
                                <x-input-error for="email" />
                            </div>


                            <div class="mb-4">
                                <x-label value="Password:" />
                                <x-input type="password" placeholder="tu  passowrd" class="w-full "
                                    name="password" />
                                <x-input-error for="password" />
                            </div>

                            {{-- <div class="mb-4">
                                                <x-label value="Passwordd:" />
                                                <x-input type="passwordd" class="w-full" name="passwordd" />
                                                <x-input-error for="passwordd"/>
                                            </div> --}}


                            <div class="mb-5">
                                <x-label value="Password:" />
                                <x-input id="password_confirmation" name="password_confirmation" type="password"
                                    placeholder="Repite tu  passowrd" class="w-full" />
                            </div>
                            <hr>
                            <div class="mt-4 mb-4">
                                <x-label value="Dirección:" />
                                <x-input type="text" name="address"
                                    value="{{ old('address', $user->employee->address) }}" placeholder="Dirección"
                                    class="w-full" />
                                <x-input-error for="address" />
                            </div>

                            <div class="flex">
                                <div class="mb-4 mr-4">
                                    <x-label value="Celular:" />
                                    <x-input type="text" name="movil"
                                        value="{{ old('movil', $user->employee->movil) }}" placeholder="Celular"
                                        class="w-full" />
                                    <x-input-error for="movil" />
                                </div>

                                <div class="mb-4">
                                    <x-label value="DNI:" />
                                    <x-input type="text" name="dni"
                                        value="{{ old('dni', $user->employee->dni) }}" placeholder="DNI"
                                        class="w-full" />
                                    <x-input-error for="dni" />
                                </div>
                            </div>

                            {{-- <div class="grid grid-cols-1 gap-1 sm:grid-cols-2 lg:grid-cols-3">

                                <div>
                                    <x-label value="Cargo:" />
                                    <select name="position_id"
                                        class="block text-sm text-gray-900 border border-gray-300 rounded-lg form-control focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Seleccione cargo</option>
                                        @foreach ($positions as $position)
                                            <option value="{{ $position->id }}"
                                                {{ old('position_id', $user->employee->position_id) == $position->id ? 'selected' : '' }}>
                                                {{ $position->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="position_id" />
                                </div>

                                <div>
                                    <x-label value="Genero:" />
                                    <select name="gender"
                                        class="block text-sm text-gray-900 border border-gray-300 rounded-lg form-control focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Escoger</option>
                                        <option value="1"
                                            {{ old('gender', $user->employee->gender) == 1 ? 'selected' : '' }}>
                                            Masculino
                                        </option>
                                        <option value="2"
                                            {{ old('gender', $user->employee->gender) == 2 ? 'selected' : '' }}>
                                            Femenino
                                        </option>
                                    </select>
                                    <x-input-error for="gender" />

                                </div>

                                <div>
                                    <x-label value="Local:" />
                                    <select name="local_id"
                                        class="block text-sm text-gray-900 border border-gray-300 rounded-lg form-control focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Selecciona un local</option>
                                        @foreach ($locales as $local)
                                            <option value="{{ $local->id }}"
                                                {{ old('local_id', $user->employee->local_id) == $local->id ? 'selected' : '' }}>
                                                {{ $local->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="local_id" />
                                </div>

                            </div> --}}


                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-2">
                                <div class="mb-4 w-full">
                                    <x-label value="Cargo:" />
                                    <select name="position_id"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg form-control focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Seleccione cargo</option>
                                        @foreach ($positions as $position)
                                            <option value="{{ $position->id }}"
                                                {{ old('position_id', $user->employee->position_id) == $position->id ? 'selected' : '' }}>
                                                {{ $position->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="position_id" />
                                </div>

                                <div class="mb-4 w-full">
                                    <x-label value="Genero:" />
                                    <select name="gender"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg form-control focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Escoger</option>
                                        <option value="1"
                                            {{ old('gender', $user->employee->gender) == 1 ? 'selected' : '' }}>
                                            Masculino
                                        </option>
                                        <option value="2"
                                            {{ old('gender', $user->employee->gender) == 2 ? 'selected' : '' }}>
                                            Femenino
                                        </option>
                                    </select>
                                    <x-input-error for="gender" />
                                </div>

                                <div class="mb-4 w-full">
                                    <x-label value="Local:" />
                                    <select name="local_id"
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg form-control focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Selecciona un local</option>
                                        @foreach ($locales as $local)
                                            <option value="{{ $local->id }}"
                                                {{ old('local_id', $user->employee->local_id) == $local->id ? 'selected' : '' }}>
                                                {{ $local->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error for="local_id" />
                                </div>
                            </div>




                            <div class="py-4">
                                <input type="file" name="photo" id="file" accept="image/*">
                            </div>
                            <div class="w-full py-4 mt-2 bg-slate-50">
                                @if ($user->employee->photo)
                                    <div>
                                        <p class=ml-4>Imagen actual del usuario</p>
                                    </div>
                                    <img class="w-20 mb-2 ml-4" src="{{ asset('img/' . $user->employee->photo) }}"
                                        alt="usuario">
                                @endif
                            </div>

                            <x-danger-button class="w-full mt-4 mb-3" type="submit">
                                <i class="mx-2 fa-regular fa-floppy-disk"></i> Actualizar datos del Usuario
                            </x-danger-button>





                        </div>
                    </div>
                </div>

            </div>
        </form>

        <div class="px-3 py-4 bg-white md:col-span-2">
            <p class="pb-4 text-lg font-bold underline underline-offset-2">Roles</p>
            <div class="mb-4">

                @role('Admin')
                    <form method="POST" action="{{ route('admin.users.roles.update', $user) }}">
                        {{ csrf_field() }} {{ method_field('PUT') }}

                        @include('admin.roles.checkboxes')

                        {{-- <button class="btn btn-primary btn-block">Actualizar Roles</button> --}}
                        <x-danger-button class="w-64 mt-4 mb-3" type="submit">
                            <i class="mx-2 fa-regular fa-floppy-disk"></i> Actualizar Roles
                        </x-danger-button>
                    </form>
                @else
                    <ul>
                        @forelse($user->roles as $role)
                            <li class="list-group-item">{{ $role->name }}</li>
                        @empty
                            <li class="list-group-item">no tiene roles</li>
                        @endforelse


                    </ul>
                @endrole

                {{--  @include('admin.roles.checkboxes') --}}
            </div>

            <p class="pb-4 text-lg font-bold underline underline-offset-2">Permisos</p>
            @role('Admin')

                {{-- @include('admin.permissions.checkboxes', ['model' => $user]) --}}

                <form method="POST" action="{{ route('admin.users.permissions.update', $user) }}">
                    {{ csrf_field() }} {{ method_field('PUT') }}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                        @include('admin.permissions.checkboxes', ['model' => $user])
                    </div>
                    <x-danger-button class="w-64 mt-4 mb-3" type="submit">
                        <i class="mx-2 fa-regular fa-floppy-disk"></i> Actualizar Permisos
                    </x-danger-button>
                </form>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                    @forelse($user->permissions as $permission)
                        <div>{{ $permission->display_name }}</div>
                    @empty
                        <div>No tiene permisos</div>
                    @endforelse


                </div>
            @endrole


        </div>
    </div>

    </div>

</x-app-layout>