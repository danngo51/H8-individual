@props(['profileName' => 'Default Name'])

<div class="box">
    <div class="titles">
        <div>
            <a class="profile-pic" href="/profile"><i class="fas fa-user-circle"></i></a>
            <h3 class="h-3" id="profileName">{{ $profileName }}</h3>
        </div>
        <h2 id="blog-title">{{ $slot }}</h2>
    </div>
    <div class="blog-template-text-field">
        <p id="blog-text" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm">{{ $slot }}</p>
    </div>
    <div>
        <button> Like </button>
        <button> Comment </button>
    </div>
</div>
