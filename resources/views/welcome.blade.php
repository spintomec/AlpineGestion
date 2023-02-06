@php
    $users = App\Models\User::all();
@endphp

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <title>Gestion utilisateur Alpine JS</title>
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body>
        <div class="container mx-auto mt-5 p-3"
            x-data="userInit({{ Js::from($users) }})"
            x-init="userWatchInit()"
        >
            <div class="my-5 text-green-500" x-ref="count">Count 0</div>

            @foreach ($users as $user)
                <x-tools.checkbox 
                    :label="$user->name"
                    :value="$user->id"
                    x-model="userIDs"
                />
                {{-- <p>{{ $user->name }}</p> --}}
            @endforeach
        </div>
        <script>
            function userInit(users) {
                return {
                    users: users,
                    userIDs: [],

                    userWatchInit() {
                        this.$watch('userIDs', (userIDs) => {
                            this.$refs.count.innerText = 'Count ' + userIDs.length;
                        
                        if (userIDs.length <= 3) {
                            this.$refs.count.classList.add('text-green-500')
                            this.$refs.count.classList.remove('text-yellow-500')
                            this.$refs.count.classList.remove('text-red-500')
                        }
                        if (userIDs.length <= 6 && userIDs.length > 3 ) {
                            this.$refs.count.classList.remove('text-red-500')
                            this.$refs.count.classList.add('text-yellow-500')
                        }
                        if (userIDs.length <= 10 && userIDs.length > 6 ) {
                            this.$refs.count.classList.add('text-red-500')
                        }
                        if (userIDs.length == this.users.length ) {
                            this.$refs.count.classList.add('text-red-800')
                            this.$refs.count.innerText = 'TOUS LES UTILISATEURS ??!?!'

                        }
                    })
                    }
                }
            }
        </script>
    </body>
</html>
