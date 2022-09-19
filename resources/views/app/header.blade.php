<header class="flex h-full">
    <div class="my-auto grow">
        <nav class="flex justify-start">
            <a class="hover:text-silver-sand mr-8" href="/rooms">会議室一覧</a>
            <a class="hover:text-silver-sand mr-8" href="/rooms/register">会議室登録</a>

            <div class="relative" id="dropdown-area">
                <button class="flex items-center" dropdown="true" data-target="dropdown-menu" id="dropdown">
                    <span>設定</span>
                    <svg class="dark:fill-cadet-blue ml-2 h-3 w-3 fill-white" version="1.1"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 129 129"
                        xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129">
                        <path
                            d="m121.3,34.6c-1.6-1.6-4.2-1.6-5.8,0l-51,51.1-51.1-51.1c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l53.9,53.9c0.8,0.8 1.8,1.2 2.9,1.2 1,0 2.1-0.4 2.9-1.2l53.9-53.9c1.7-1.6 1.7-4.2 0.1-5.8z" />
                    </svg>
                </button>
                <div class="dark:bg-outer-space text-shark-100 border-geyser dark:border-mako invisible absolute w-48 overflow-hidden rounded border bg-white"
                    id="dropdown-menu">
                    <a class="hover:bg-science-blue dark:hover:text-silver-sand dark:border-mako whitespace-no-wrap dark:text-cadet-blue block border-b px-4 py-3 no-underline hover:text-white"
                        href="/templates">予約テンプレート一覧</a>
                    <a class="hover:bg-science-blue dark:hover:text-silver-sand dark:border-mako whitespace-no-wrap dark:text-cadet-blue block border-b px-4 py-3 no-underline hover:text-white"
                        href="/templates/register">予約テンプレート登録</a>
                </div>
            </div>
        </nav>
    </div>

    <div class="my-auto w-10">
        <button class="hover:bg-river-bed-200 rounded-md p-2.5" id="theme-toggle" type="button">
            <svg class="h-6 w-6" id="theme-toggle-light-icon" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                    fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
            <svg class="h-6 w-6" id="theme-toggle-dark-icon" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
        </button>
    </div>
</header>
