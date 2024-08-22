<nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center">
            <!-- Logo -->
            <a href="<?php echo URLROOT.'/'; ?>" class="text-2xl font-bold text-gray-800">CIPHER</a>
            
            <!-- Search Bar -->
            <form method="GET" action="<?php echo URLROOT; ?>/question/search" class="relative w-full max-w-md mx-4">
                <input type="text" name="search" class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Search..." autocomplete="off" onkeypress="event.keyCode == 13 ? this.form.submit() : ''">
                <button type="submit">
                    <svg class="absolute left-3 top-2.5 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11h4m-2-2v4m5-3h.01M13 21h-1c-2.003 0-3.8-1.192-4.58-2.917C6.646 16.202 6 14.21 6 12c0-3.866 3.134-7 7-7s7 3.134 7 7c0 1.108-.188 2.17-.53 3.142M18 19l-1 1m4-4-4-4"/>
                    </svg>
                </button>
            </form>

            <!-- Right Side Menu -->
            <div class="flex items-center space-x-4">
                <a href="<?php echo URLROOT.'/about'; ?>" class="text-gray-600 hover:text-gray-800">About Us</a>
                <a href="<?php echo URLROOT.'/contact';?>" class="text-gray-600 hover:text-gray-800">Contact Us</a>
                <a href="<?php echo URLROOT.'/question'; ?>" class="text-gray-600 hover:text-gray-800">Question</a>
                <a href="<?php echo URLROOT.'/question/create'; ?>" class="text-gray-600 hover:text-gray-800">Ask a question</a>
                <?php if(isset($_SESSION['email'])): ?>
                    <a href="<?php echo URLROOT.'/user/profile'; ?>" class="text-gray-600 hover:text-gray-800">Profile</a>
                    <a href="<?php echo URLROOT.'/user/logout'; ?>" class="text-gray-600 hover:text-gray-800">Logout</a>
                <?php else: ?>
                <a href="<?php echo URLROOT.'/user/login'; ?>" class="text-gray-600 hover:text-gray-800">Log in</a>
                <a href="<?php echo URLROOT.'/user/register'; ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Sign up</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>