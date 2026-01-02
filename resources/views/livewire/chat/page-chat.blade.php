<div x-data="chatSubscription(@js($pairId))" x-init="initSubscription()"
     class="flex flex-col h-[calc(100vh-5rem)] lg:flex-row">

    <div class="flex flex-col flex-1 gap-6 lg:p-8 overflow-hidden">

        <div class="flex flex-col flex-1 min-h-0">

            <livewire:chat.chat-header-card
                :header-user="$headerUser"
                :display-header="$displayHeader"
                wire:key="header-{{ $headerUser?->id ?? 'no-user' }}-{{ $displayHeader ? '1' : '0' }}"
            />


            <div class=" mt-4 flex flex-1 min-h-0">
                <livewire:chat.chat-component
                    :is-chat-active="$isChatActive"
                    :pair-id="$pairId"
                    :partner-name="$partnerName"
                    wire:key="chat-area-{{ $isChatActive ? 'active' : 'inactive' }}-{{ $headerUser?->id ?? 'no-partner' }}"
                />
            </div>
        </div>
    </div>
    {{--    <div class="hidden lg:block w-96 flex-shrink-0 border-l border-gray-200 dark:border-gray-700">--}}
    {{--        <livewire:chat.right-sidbar/>--}}
    {{--    </div>--}}
    <script>

        function chatSubscription(initialPairId) {
            return {
                isSubscribed: false,
                channel: null,
                currentPairId: initialPairId || null,

                startSubscription(pairId) {
                    if (!pairId || this.isSubscribed) return;

                    if (!window.Echo) {
                        console.error('Błąd: window.Echo nie jest zdefiniowane!');
                        return;
                    }

                    this.currentPairId = pairId;
                    this.isSubscribed = true;
                    const channelName = `chat.${pairId}`;
                    console.log('Subskrybuję kanał:', channelName);

                    this.channel = window.Echo.join(channelName)
                        .here((users) => {
                            Livewire.dispatch('presenceHere', {users});
                        })
                        .joining((user) => {
                            Livewire.dispatch('presenceJoining', {user});
                        })
                        .leaving((user) => {
                            Livewire.dispatch('presenceLeaving', {user});
                        })
                        .listen('MessageChat', (payload) => {
                            Livewire.dispatch('newMessage', {payload});
                        })
                        .listen('MessageRemove', (payload) => {
                            Livewire.dispatch('removeMessage', {payload})
                        })
                        .error((error) => {
                            console.error('Błąd Echo:', error);
                            this.isSubscribed = false;
                        });
                },

                // NOWA METODA – rozłączanie z kanału
                stopSubscription() {
                    if (!this.isSubscribed || !this.channel) {
                        console.log('Nie ma aktywnej subskrypcji do zamknięcia.');
                        return;
                    }

                    console.log('Opuszczam kanał chat.' + this.currentPairId);
                    const channelName = `chat.${this.currentPairId}`;
                    window.Echo.leave(channelName);
                    this.channel = null;
                    this.isSubscribed = false;
                    this.currentPairId = null;

                    console.log('Rozłączono z kanałem.');
                },

                initSubscription() {
                    console.log('Inicjalizacja chat subscription...');

                    if (initialPairId) {
                        this.$nextTick(() => this.startSubscription(initialPairId));
                    }

                    // Nasłuchiwanie na eventy z Livewire
                    document.addEventListener('livewire:initialized', () => {
                        Livewire.on('startChatSubscription', (data) => {
                            let pairId = data.pairId || (Array.isArray(data) ? data[0]?.pairId : data);
                            if (pairId) this.startSubscription(pairId);
                        });

                        // Dodatkowy event do wymuszonego rozłączenia
                        Livewire.on('stopChatSubscription', () => {
                            this.stopSubscription();
                        });
                    });

                    // Opcjonalnie: rozłącz przy opuszczeniu strony
                    window.addEventListener('beforeunload', () => {
                        this.stopSubscription();
                    });
                }
            }
        }
    </script>
</div>
