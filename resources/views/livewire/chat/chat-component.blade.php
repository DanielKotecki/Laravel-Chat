<div
    class="card bg-base-100 shadow-xl border-4 rounded-2xl flex flex-col flex-1 overflow-hidden relative transition-all duration-500 {{ $isChatActive ? 'border-success' : 'border-error' }}">

    <!-- Status połączenia -->
    <div
        class="text-center py-2 text-sm font-semibold {{ $isChatActive ? 'bg-success/20 text-success' : 'bg-error/20 text-error' }}">
        {{ $isChatActive ? __('chat.chat.connected') : __('chat.chat.disconnect') }}
    </div>

    <!-- Lista wiadomości -->
    <div class="flex-1 overflow-y-auto p-6 space-y-6"
         id="messages-container"
         x-on:click="if ($event.target.closest('[data-reply-to]')) {
         const uuid = $event.target.closest('[data-reply-to]').dataset.replyTo;
         const target = document.querySelector(`[data-content='${uuid}']`);
         if (target) {
             const messageEl = target.closest('.group');
             messageEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
             messageEl.classList.add('ring-4', 'ring-primary/50');
             setTimeout(() => messageEl.classList.remove('ring-4', 'ring-primary/50'), 2000);
         }
     }">
        @foreach($messagesList as $message)
            @if($message['userId'] !== $myId)
                <!-- Wiadomość od rozmówcy -->
                <div class="group flex gap-4 hover:bg-base-200/50 -mx-6 px-6 py-3 rounded-xl transition "
                     data-message-uuid="{{ $message['uuid'] }}">
                    <div class="flex-1">
                        <p class="font-semibold text-sm">{{ $partnerName }}</p>

                        @if($message['replyToUuid'] && $message['replyContent'])
                            <div class="-mb-1 flex justify-start" data-reply-to="{{ $message['replyToUuid'] }}">
                                <div
                                    class="bg-base-400 rounded-xl px-4 py-2 text-sm opacity-70 max-w-[80%] cursor-pointer hover:opacity-100 transition">
                                    <p class="italic text-base-content/70 leading-snug break-words line-clamp-2">
                                        {{ $message['replyContent'] }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="chat chat-start">
                            <div class="mt-1 bg-base-200 rounded-2xl px-5 py-3 max-w-lg inline-block">
                                <p class="break-words {{ $message['content'] ? '' : 'italic' }}"
                                   data-content="{{ $message['uuid'] }}">
                                    {{ $message['content'] ?? __('chat.chat.messages.removed') }}
                                </p>
                            </div>
                        </div>

                        <p class="text-xs text-base-content/50 mt-1">
                            {{ $message['sentAt']->diffForHumans() }}
                        </p>
                    </div>

                    <div class="opacity-0 group-hover:opacity-100 transition">
                        <x-mary-dropdown position="right">
                            <x-mary-menu-item
                                title="{{ __('chat.chat.actions.reply') }}"
                                icon="o-arrow-path"
                                class="reply-button"
                                wire:click.debounce="handleReplay('{{ $message['uuid'] }}')"
                                x-on:click.prevent="
                                    setTimeout(() => {
                                        const el = document.getElementById('reply-form');
                                        if (el) {
                                            el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                            const textarea = el.querySelector('textarea');
                                            if (textarea) textarea.focus();
                                        }
                                    }, 150);"
                            />
                            <x-mary-menu-item
                                title="{{ __('chat.chat.actions.copy') }}"
                                icon="o-document-duplicate"
                                x-on:click.prevent="
                                    const uuid = $el.closest('.group').dataset.messageUuid;
                                    const contentEl = document.querySelector(`[data-content='${uuid}']`);
                                    if (contentEl) {
                                        const text = contentEl.textContent.trim();
                                        if (text) {
                                            navigator.clipboard.writeText(text).then(() => {
                                                $el.querySelector('span')?.setAttribute('data-original-title', $el.querySelector('span').innerText);
                                            }).catch(() => {
                                                alert('Error');
                                            });
                                        }
                                    }
                                "
                            />
                        </x-mary-dropdown>
                    </div>
                </div>
            @else
                <!-- Twoja wiadomość -->
                <div class="group flex gap-4 hover:bg-base-200/50 -mx-6 px-6 py-3 rounded-xl transition justify-end"
                     data-message-uuid="{{ $message['uuid'] }}">
                    <div class="opacity-0 group-hover:opacity-100 transition">
                        <x-mary-dropdown position="right">
                            <x-mary-menu-item
                                title="{{ __('chat.chat.actions.reply') }}"
                                icon="o-arrow-path"
                                class="reply-button"
                                wire:click.debounce="handleReplay('{{ $message['uuid'] }}')"
                                x-on:click.prevent="
                                    setTimeout(() => {
                                        const el = document.getElementById('div-form');
                                        if (el) {
                                            el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                            const textarea = el.querySelector('textarea');
                                            if (textarea) textarea.focus();
                                        }
                                    }, 150);"
                            />
                            <x-mary-menu-item
                                title="{{ __('chat.chat.actions.copy') }}"
                                icon="o-document-duplicate"
                                x-on:click.prevent="
                                    const uuid = $el.closest('.group').dataset.messageUuid;
                                    const contentEl = document.querySelector(`[data-content='${uuid}']`);
                                    if (contentEl) {
                                        const text = contentEl.textContent.trim();
                                        if (text) {
                                            navigator.clipboard.writeText(text).then(() => {
                                                $el.querySelector('span')?.setAttribute('data-original-title', $el.querySelector('span').innerText);

                                            }).catch(() => {
                                                alert('Error');
                                            });
                                        }
                                    }
                                "
                            />
                            <x-mary-menu-item
                                title="{{ __('chat.chat.actions.remove') }}"
                                icon="o-trash"
                                class="text-error hover:bg-error/10"
                                wire:click.debounce="handleRemove('{{ $message['uuid'] }}')"
                            />
                        </x-mary-dropdown>
                    </div>

                    <div class="text-right max-w-lg">
                        @if($message['replyToUuid'] && $message['replyContent'])
                            <div class="-mb-1 flex justify-end" data-reply-to="{{ $message['replyToUuid'] }}">
                                <div
                                    class="bg-base-400 rounded-xl px-4 py-2 text-sm opacity-70 max-w-[80%] cursor-pointer hover:opacity-100 transition">
                                    <p class="italic text-base-content/70 leading-snug break-words line-clamp-2">
                                        {{ $message['replyContent'] }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="chat chat-end">
                            <div class="mt-1 bg-base-200 rounded-2xl px-5 py-3 max-w-lg inline-block">
                                <p class="break-words {{ $message['content'] ? '' : 'italic' }}"
                                   data-content="{{ $message['uuid'] }}">
                                    {{ $message['content'] ?? __('chat.chat.messages.removed') }}
                                </p>
                            </div>
                        </div>

                        <p class="text-xs text-base-content/50 mt-1">
                            {{ $message['sentAt']->diffForHumans() }}
                        </p>
                    </div>
                </div>
            @endif
        @endforeach
        <div id="messages-end"></div>
    </div>

    <!-- Pole wpisywania wiadomości -->
    <div class="border-t border-base-300 bg-base-200/70 px-6 py-5">
        <!-- Sugestie wiadomości -->
        @if($isChatActive && !$firstMessageSent)
            <div class="mb-5 flex flex-wrap gap-3 overflow-x-auto pb-2">
                @foreach(__('chat.chat.suggestions') as $suggestion)
                    <label
                        class="badge badge-lg badge-outline flex items-center justify-center border-1 rounded-xl border-primary bg-primary/35 text-sm font-medium cursor-pointer whitespace-nowrap transition-all"
                        wire:click.debounce="insertSuggestion(@js($suggestion))"
                    >
                        <span class="text-sm font-medium">{{ $suggestion }}</span>
                    </label>
                @endforeach
            </div>
        @endif

        <!-- Podgląd odpowiedzi -->
        @if($form->replyToUuid)
            <div class="mb-4 p-4 bg-base-300/50 rounded-2xl relative border-l-4 border-primary">
                <div class="flex justify-between items-start">
                    <div class="flex-1 pr-8">
                        <p class="text-sm font-semibold text-base-content/70 mb-1">
                            {{ __('chat.chat.replying.replying_to') }} {{ $replyToUserName }}
                        </p>
                        <p class="text-sm italic text-base-content/80 break-words">
                            "{{ $form->replyContent ?? __('chat.message_removed') }}"
                        </p>
                    </div>
                    <button
                        wire:click="handleCancelReply"
                        class="absolute top-3 right-3 text-base-content/50 hover:text-error transition cursor-pointer"
                        title="{{ __('chat.chat.replay.cancel_reply') }}"
                    >
                        <x-mary-icon name="o-x-mark" class="w-5 h-5"/>
                    </button>
                </div>
            </div>
        @endif

        <div class="flex items-center gap-5" id="div-form">
            <div class="flex-1">
                <x-mary-textarea
                    placeholder="{{ __('chat.chat.form.input-text') }}"
                    class="w-full input-lg bg-base-200/70"
                    rounded
                    :disabled="!$isChatActive"
                    wire:model.live="form.content"
                    x-data
                    @keydown.enter.prevent="
                    if (!$event.shiftKey) {
                        $wire.call('sendMessage')
                    }
                "
                />

            </div>
            <x-mary-button
                icon="o-paper-airplane"
                class="btn-circle btn-lg -rotate-45 shadow-lg"
                :class="$isChatActive ? 'btn-primary' : 'btn-disabled text-base-content/30'"
                tooltip-left="Wyślij (Enter)"
                :disabled="!$isChatActive"
                type="submit"
                wire:click.debounce="sendMessage"
            />
        </div>
    </div>

    <!-- Overlay przy braku połączenia -->
    @if(!$isChatActive)
        <div
            class="absolute inset-0 bg-black/80 backdrop-blur-lg flex items-center justify-center z-20 px-4 sm:px-6 lg:px-8 xl:px-12">
            <div class="text-center animate-in fade-in zoom-in duration-500">
                <div
                    class="mx-auto w-24 h-24 sm:w-32 sm:h-32 md:w-36 md:h-36 lg:w-40 lg:h-40 xl:w-48 xl:h-48 2xl:w-56 2xl:h-56 mb-4 sm:mb-6 lg:mb-8 relative">
                    <div class="absolute inset-0 rounded-full bg-error/20 animate-ping"></div>
                    <div class="relative flex items-center justify-center h-full">

                        <svg
                            class="w-16 h-16 sm:w-24 sm:h-24 md:w-28 md:h-28 lg:w-32 lg:h-32 xl:w-40 xl:h-40 2xl:w-48 2xl:h-48 text-error drop-shadow-2xl"
                            fill="#000000" viewBox="0 0 36 36" version="1.1" preserveAspectRatio="xMidYMid meet"
                            stroke="currentColor" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>disconnect-solid</title>
                            <path d="M12,6a6.21,6.21,0,0,0-6.21,5H2v2H5.83A6.23,6.23,0,0,0,12,18H17V6Z"
                                  class="clr-i-solid clr-i-solid-path-1"></path>
                            <path
                                d="M33.79,23H30.14a6.25,6.25,0,0,0-6.21-5H19v2H14a1,1,0,0,0-1,1,1,1,0,0,0,1,1h5v4H14a1,1,0,0,0-1,1,1,1,0,0,0,1,1h5v2h4.94a6.23,6.23,0,0,0,6.22-5h3.64Z"
                                class="clr-i-solid clr-i-solid-path-2"></path>
                            <rect x="0" y="0" width="36" height="36" fill-opacity="0"/>
                        </svg>
                    </div>
                </div>

                <h2 class="text-4xl sm:text-6xl md:text-7xl lg:text-8xl xl:text-9xl 2xl:text-[10rem] font-black text-error tracking-tighter drop-shadow-2xl mb-2 sm:mb-4 lg:mb-6 leading-none">
                    {{ __('chat.chat.disconnect') }}
                </h2>
            </div>
        </div>
    @endif
    <script>
        function scrollToBottom() {
            const end = document.getElementById('messages-end');
            if (!end) return;

            end.scrollIntoView({
                behavior: 'smooth',
                block: 'end',
            });
        }

        document.addEventListener('DOMContentLoaded', scrollToBottom);
        document.addEventListener('scroll-to-bottom', () => {
            const container = document.getElementById('messages-container');
            const nearBottom = container.scrollHeight - container.scrollTop - container.clientHeight < 150;

            if (nearBottom) {
                setTimeout(() => {
                    scrollToBottom();
                }, 600);
            }
        });
    </script>

</div>
