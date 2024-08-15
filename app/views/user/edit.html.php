<?php

require_once 'app/views/partials/head.php';
require_once 'app/views/partials/nav.php';
?>


<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden my-10 p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Left Side: Avatar and Basic Info -->
            <div class="text-center md:col-span-1">
                <img class="w-32 h-32 rounded-full mx-auto" src="https://via.placeholder.com/150" alt="User Avatar">
                
                <!-- Avatar Upload -->
                <input class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none mt-4" id="avatar" type="file">
                
                <h2 class="text-2xl font-semibold mt-4">John Doe</h2>
                <p class="text-gray-600">johndoe45@gmail.com</p>
                <p class="text-gray-600 mt-2">United States</p>
            </div>

            <!-- Right Side: User Details -->
            <div class="md:col-span-2">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Name -->
                    <div class="flex flex-col py-2 border-b">
                        <label class="text-gray-600">Name</label>
                        <input type="text" class="border border-gray-300 rounded-lg p-2 mt-1" value="John Doe">
                    </div>
                    <!-- Role -->
                    <div class="flex flex-col py-2 border-b">
                        <label class="text-gray-600">Role</label>
                        <input type="text" class="border border-gray-300 rounded-lg p-2 mt-1" value="User" readonly>
                    </div>
                    <!-- Email -->
                    <div class="flex flex-col py-2 border-b">
                        <label class="text-gray-600">Email</label>
                        <input type="email" class="border border-gray-300 rounded-lg p-2 mt-1" value="johndoe45@gmail.com">
                    </div>
                    <!-- Email Verification -->
                    <div class="flex flex-col py-2 border-b">
                        <label class="text-gray-600">Email Verification</label>
                        <input type="text" class="border border-gray-300 rounded-lg p-2 mt-1 text-orange-500" value="Pending" readonly>
                    </div>
                    <!-- Contact -->
                    <div class="flex flex-col py-2 border-b">
                        <label class="text-gray-600">Contact</label>
                        <input type="text" class="border border-gray-300 rounded-lg p-2 mt-1" value="+987 6789 9876 456">
                    </div>
                    <!-- Mobile Verification -->
                    <div class="flex flex-col py-2 border-b">
                        <label class="text-gray-600">Mobile Verification</label>
                        <input type="text" class="border border-gray-300 rounded-lg p-2 mt-1 text-green-500" value="Active" readonly>
                    </div>
                    <!-- Status -->
                    <div class="flex flex-col py-2 border-b">
                        <label class="text-gray-600">Status</label>
                        <input type="text" class="border border-gray-300 rounded-lg p-2 mt-1 text-green-500" value="Active" readonly>
                    </div>
                </div>
                <!-- Save Button -->
                <div class="text-center mt-6">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php
require_once 'app/views/partials/footer.php';    
?>