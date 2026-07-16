<x-app-layout>

    <!-- Global Header -->
    <div class="w-full bg-[#445344] py-24 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 font-poppins">Account</h1>
        <p class="text-white text-sm md:text-base tracking-wide font-medium">Home || Account Setting</p>
    </div>

    <!-- The Master Section -->
    <div class="w-full bg-white">
        <div class="max-w-[1200px] mx-auto px-4 pt-12 pb-16">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            
            <!-- LEFT COLUMN: User Details & Form -->
            <div class="flex flex-col gap-8">
                
                <!-- Card A: Name & Email -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
                    <h2 class="text-3xl font-bold text-[#0f172a] mb-2" style="font-family: 'Poppins', sans-serif;">{{ $user->name }}</h2>
                    <div class="flex items-center gap-2 text-gray-500">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span class="text-base font-medium">{{ $user->email }}</span>
                    </div>
                </div>

                <!-- Card B: Personal Information -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden" x-data="{ isEditing: false }">
                    <!-- Header -->
                    <div class="bg-[#445344] px-6 py-4 flex justify-between items-center">
                        <h3 class="text-white font-bold text-lg">Personal Information</h3>
                        <button type="button" @click="isEditing = !isEditing" class="bg-white text-[#445344] hover:bg-gray-100 font-bold text-sm px-4 py-1.5 rounded transition-colors shadow-sm" x-show="!isEditing">
                            Edit
                        </button>
                    </div>
                    
                    <!-- Body -->
                    <div class="p-6">
                        
                        <!-- READ ONLY STATE -->
                        <div x-show="!isEditing" class="flex flex-col gap-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-1">Full Name</label>
                                <p class="text-base text-gray-600 m-0 p-0 leading-none">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-1">Email</label>
                                <p class="text-base text-gray-600 m-0 p-0 leading-none">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-1">Jenis Kelamin</label>
                                <p class="text-base text-gray-600 m-0 p-0 leading-none">Laki-Laki</p>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-1">Tanggal Lahir</label>
                                <p class="text-base text-gray-600 m-0 p-0 leading-none">02 Mei 2005</p>
                            </div>
                        </div>

                        <!-- EDIT STATE -->
                        <div x-show="isEditing" style="display: none;">
                            <form method="post" action="{{ route('profile.update') }}" class="flex flex-col gap-5">
                                @csrf
                                @method('patch')
                                
                                <div>
                                    <label class="block text-sm font-bold text-gray-800 mb-2">Full Name</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full rounded-md border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-[#445344] focus:border-[#445344] bg-white transition-colors">
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-bold text-gray-800 mb-2">Email</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full rounded-md border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-[#445344] focus:border-[#445344] bg-white transition-colors">
                                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-bold text-gray-800 mb-2">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="w-full rounded-md border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-[#445344] focus:border-[#445344] bg-white transition-colors">
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-bold text-gray-800 mb-2">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" value="2005-05-02" class="w-full rounded-md border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-[#445344] focus:border-[#445344] bg-white transition-colors">
                                </div>
                                
                                <div class="flex items-center gap-4 mt-2">
                                    <button type="submit" class="bg-[#445344] text-white hover:bg-[#364236] font-bold text-sm px-6 py-2.5 rounded transition-colors shadow-sm">
                                        Save Profile
                                    </button>
                                    <button type="button" @click="isEditing = false" class="text-gray-500 hover:text-gray-700 font-medium text-sm transition-colors">
                                        Cancel
                                    </button>
                                    
                                    @if (session('status') === 'profile-updated')
                                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-medium">{{ __('Saved.') }}</p>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card C: Update Password -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
                    <!-- Header -->
                    <div class="bg-[#445344] px-6 py-4">
                        <h3 class="text-white font-bold text-lg">Update Password</h3>
                    </div>
                    
                    <!-- Body -->
                    <div class="p-6">
                        <form method="post" action="{{ route('password.update') }}" class="flex flex-col gap-5">
                            @csrf
                            @method('put')
                            
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-2">Current Password</label>
                                <input type="password" name="current_password" class="w-full rounded-md border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-[#445344] focus:border-[#445344] bg-white transition-colors">
                                <x-input-error class="mt-2" :messages="$errors->updatePassword->get('current_password')" />
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-2">New Password</label>
                                <input type="password" name="password" class="w-full rounded-md border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-[#445344] focus:border-[#445344] bg-white transition-colors">
                                <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password')" />
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-2">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="w-full rounded-md border border-gray-300 px-4 py-2.5 text-sm focus:outline-none focus:ring-[#445344] focus:border-[#445344] bg-white transition-colors">
                                <x-input-error class="mt-2" :messages="$errors->updatePassword->get('password_confirmation')" />
                            </div>

                            <div class="flex items-center gap-4 mt-2">
                                <button type="submit" class="bg-[#445344] hover:bg-[#364236] text-white font-medium px-6 py-2 rounded-md transition-colors shadow-sm">
                                    Save Password
                                </button>
                                
                                @if (session('status') === 'password-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 font-medium">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Card D: Delete Account -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden" x-data="{ confirmingUserDeletion: false }">
                    <!-- Header -->
                    <div class="bg-[#445344] text-white font-bold py-4 px-6 rounded-t-lg">
                        <h3 class="text-white font-bold text-lg">Delete Account</h3>
                    </div>
                    
                    <!-- Body -->
                    <div class="p-6">
                        <p class="text-sm text-gray-600 mb-5">
                            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
                        </p>
                        <button type="button" @click="confirmingUserDeletion = true" class="bg-white border border-red-500 text-red-500 hover:bg-red-50 font-medium px-6 py-2 rounded-md transition-colors shadow-sm">
                            Delete Account
                        </button>

                        <!-- Modal -->
                        <div x-show="confirmingUserDeletion" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                
                                <!-- Background overlay -->
                                <div x-show="confirmingUserDeletion" x-transition.opacity class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                                
                                <!-- Modal panel -->
                                <div x-show="confirmingUserDeletion" x-transition class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                        @csrf
                                        @method('delete')

                                        <h2 class="text-lg font-bold text-gray-800">
                                            Are you sure you want to delete your account?
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-600">
                                            Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                                        </p>

                                        <div class="mt-6">
                                            <label for="password" class="sr-only">Password</label>
                                            <input type="password" name="password" id="password" class="focus:border-[#445344] focus:ring focus:ring-[#445344] focus:ring-opacity-50 rounded-md border border-gray-300 shadow-sm w-full px-4 py-2.5 text-sm bg-white transition-colors" placeholder="Password">
                                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                        </div>

                                        <div class="mt-6 flex justify-end gap-4">
                                            <button type="button" @click="confirmingUserDeletion = false" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium px-6 py-2 rounded-md transition-colors">
                                                Cancel
                                            </button>
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-2 rounded-md transition-colors">
                                                Delete Account
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Order History -->
            <div class="flex flex-col">
                
                @if($activeOrders->isEmpty())
                <!-- Card: Active Orders (Empty) -->
                <div class="mb-6 flex flex-col shadow-sm bg-white border border-gray-200 rounded-lg overflow-hidden h-full min-h-[400px]">
                    <div class="bg-[#445344] px-6 py-4">
                        <h3 class="text-white font-bold text-lg">Active Orders</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col items-center justify-center py-24 text-center bg-white">
                        <h4 class="text-lg font-bold text-gray-800">No active orders.</h4>
                        <p class="text-sm text-gray-400 mt-2">You don't have any orders currently being processed.</p>
                    </div>
                </div>
                @else
                                <div x-data="{ expandedActive: false }" class="mb-6 flex flex-col shadow-sm bg-white border border-gray-200 rounded-lg overflow-hidden">
                    <!-- Single Master Header -->
                    <div class="bg-[#445344] px-6 py-4">
                        <h3 class="text-white font-bold text-lg">Active Orders</h3>
                    </div>
                    
                    <!-- Single Master Body -->
                    <div class="bg-white p-6">
                        @foreach($activeOrders as $index => $order)
                        <div @if($index >= 2) x-show="expandedActive" x-transition @endif class="flex flex-col {{ $index > 0 ? 'mt-5' : '' }}">
                            <div class="font-bold text-gray-800 border-b pb-3 mb-5">Order ID: {{ $order->nomor_pesanan }}</div>
                        
                        <!-- Order Details -->
                        <div class="flex flex-col gap-1 text-sm text-gray-700">
                            <div class="flex justify-between">
                                <span class="font-bold">Product:</span>
                                <span class="text-right font-medium">
                                    @foreach($order->items as $item)
                                        {{ $item->product->nama_produk ?? 'Product' }} (x{{ $item->kuantitas }})<br>
                                    @endforeach
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-bold">Payment Method:</span>
                                <span class="text-right font-medium">{{ $order->metode_pembayaran ?? 'QRIS' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-bold">Discount:</span>
                                <span class="text-right font-medium">{{ $order->diskon ?? 0 }} IDR</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="font-bold">Shipping Fee:</span>
                                <span class="text-right font-medium">{{ number_format($order->ongkir, 0, ',', '.') }} IDR</span>
                            </div>
                            <div class="flex justify-between mt-1 pt-1 border-t border-gray-100">
                                <span class="font-bold text-gray-900">Grand Total:</span>
                                <span class="text-right font-bold text-gray-900">{{ number_format($order->total_harga, 0, ',', '.') }} IDR</span>
                            </div>
                        </div>

                        @php
                            $status = strtolower($order->status_pesanan);
                            
                            $isCompleted = [
                                1 => in_array($status, ['processing', 'proses', 'processed', 'shipped', 'dikirim', 'delivered', 'selesai']),
                                2 => in_array($status, ['processed', 'shipped', 'dikirim', 'delivered', 'selesai']),
                                3 => in_array($status, ['shipped', 'dikirim', 'delivered', 'selesai']),
                                4 => in_array($status, ['delivered', 'selesai'])
                            ];
                        @endphp

                        <!-- Visual Tracker (Stepper) -->
                        <div class="relative flex items-center justify-between text-center mt-6 mb-4 px-2">
                            <!-- Horizontal Line -->
                            <div class="absolute left-0 top-4 -translate-y-1/2 w-full h-1 bg-gray-200 z-0"></div>
                            
                            <!-- Step 1 -->
                            <div class="flex-1 relative z-10 flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mb-2 ring-4 ring-white {{ $isCompleted[1] ? 'bg-[#445344] text-white shadow-sm' : 'bg-gray-100 text-gray-500' }}">
                                    @if($isCompleted[1])
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        1
                                    @endif
                                </div>
                                <span class="text-xs {{ $isCompleted[1] ? 'font-bold text-[#445344]' : 'font-medium text-gray-500' }} leading-tight mt-1">Validasi<br>Pembayaran</span>
                            </div>

                            <!-- Step 2 -->
                            <div class="flex-1 relative z-10 flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mb-2 ring-4 ring-white {{ $isCompleted[2] ? 'bg-[#445344] text-white shadow-sm' : 'bg-gray-100 text-gray-500' }}">
                                    @if($isCompleted[2])
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        2
                                    @endif
                                </div>
                                <span class="text-xs {{ $isCompleted[2] ? 'font-bold text-[#445344]' : 'font-medium text-gray-500' }} leading-tight mt-1">Pesanan<br>Diproses</span>
                            </div>

                            <!-- Step 3 -->
                            <div class="flex-1 relative z-10 flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mb-2 ring-4 ring-white {{ $isCompleted[3] ? 'bg-[#445344] text-white shadow-sm' : 'bg-gray-100 text-gray-500' }}">
                                    @if($isCompleted[3])
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        3
                                    @endif
                                </div>
                                <span class="text-xs {{ $isCompleted[3] ? 'font-bold text-[#445344]' : 'font-medium text-gray-500' }} leading-tight mt-1">Sedang<br>Dikirim</span>
                            </div>

                            <!-- Step 4 -->
                            <div class="flex-1 relative z-10 flex flex-col items-center">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mb-2 ring-4 ring-white {{ $isCompleted[4] ? 'bg-[#445344] text-white shadow-sm' : 'bg-gray-100 text-gray-500' }}">
                                    @if($isCompleted[4])
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        4
                                    @endif
                                </div>
                                <span class="text-xs {{ $isCompleted[4] ? 'font-bold text-[#445344]' : 'font-medium text-gray-500' }} leading-tight mt-1">Tiba di<br>Tujuan</span>
                            </div>
                        </div>

                        @if($order->status_pesanan === 'shipped')
                            <div class="flex justify-end mt-4 mb-6">
                                <form action="{{ route('user.orders.confirm-delivered', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-4 py-2.5 rounded-lg transition duration-150 ease-in-out cursor-pointer inline-block">
                                        Pesanan Telah Tiba
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="mb-6"></div>
                        @endif
                        </div>
                        @endforeach
                        
                        @if($activeOrders->count() > 2)
                        <div class="flex justify-center mt-4 mb-4">
                            <button type="button" 
                                    @click="expandedActive = !expandedActive" 
                                    class="text-xs font-semibold text-gray-500 hover:text-gray-700 bg-white hover:bg-gray-50 border border-gray-200 px-5 py-2 rounded-full shadow-sm transition cursor-pointer">
                                <span x-show="!expandedActive">View More</span>
                                <span x-show="expandedActive">View Less</span>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                
                <!-- Card C: Order History -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden h-full min-h-[400px] flex flex-col">
                    <!-- Header -->
                    <div class="bg-[#445344] px-6 py-4">
                        <h3 class="text-white font-bold text-lg">Order History</h3>
                    </div>
                    
                    <!-- Body -->
                    <div x-data="{ expanded: false }" class="p-6 flex-1 flex flex-col {{ $historyOrders->isEmpty() ? 'items-center justify-center py-24 text-center' : '' }}">
                        @if($historyOrders->isEmpty())
                            <h4 class="text-lg font-bold text-gray-800">No order history.</h4>
                            <p class="text-sm text-gray-400 mt-2">You haven't placed any orders yet.</p>
                        @else
                            @foreach($historyOrders as $order)
                            <div x-data="orderCard({{ $order->id }})" @if($loop->index >= 2) x-show="expanded && !hidden" @else x-show="!hidden" @endif x-transition.opacity.duration.300ms class="bg-white rounded-2xl border border-gray-100 p-5 mb-4 shadow-sm">
                                <!-- Order Header (ID, Date, and Status Badge) -->
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h4 class="font-bold text-gray-800 text-sm">Order #{{ $order->nomor_pesanan }}</h4>
                                        <p class="text-xs text-gray-400 mt-1">{{ $order->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                    @php
                                        $displayStatus = ucfirst($order->status_pesanan);
                                        $badgeClass = 'bg-blue-50 text-blue-600';
                                        
                                        if (in_array($order->status_pesanan, ['pending_payment', 'pending'])) {
                                            $displayStatus = 'Menunggu Pembayaran';
                                            $badgeClass = 'bg-yellow-50 text-yellow-600';
                                        } elseif (in_array($order->status_pesanan, ['processing', 'proses'])) {
                                            $displayStatus = 'Diproses';
                                            $badgeClass = 'bg-indigo-50 text-indigo-600';
                                        } elseif ($order->status_pesanan == 'shipped') {
                                            $displayStatus = 'Dalam Pengiriman';
                                            $badgeClass = 'bg-blue-50 text-blue-600';
                                        } elseif (in_array($order->status_pesanan, ['delivered', 'selesai'])) {
                                            $displayStatus = 'Selesai';
                                            $badgeClass = 'bg-green-50 text-green-600';
                                        }
                                    @endphp
                                    <!-- Status & Action Container -->
                                    <div class="flex items-center gap-3">
                                        <!-- Status Badge -->
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badgeClass }}">
                                            {{ $displayStatus }}
                                        </span>
                                        @if(in_array($order->status_pesanan, ['delivered', 'selesai']))
                                        <!-- Delete / Hide Button -->
                                        <button @click="hideOrder()" type="button" class="text-gray-400 hover:text-red-500 transition-colors duration-200 focus:outline-none p-1 rounded-lg hover:bg-gray-50" title="Hapus Histori">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Product Detail Section (Horizontal Layout with Thumbnail) -->
                                <div class="flex items-center gap-4">
                                    <!-- Product Thumbnail (FORCE FIXED SIZE) -->
                                    <div class="w-16 h-16 flex-shrink-0 bg-gray-50 rounded-xl overflow-hidden border border-gray-100">
                                        @php
                                            $firstItem = $order->items->first();
                                            $foto = $firstItem && $firstItem->product ? $firstItem->product->foto_produk : null;
                                            $totalItems = $order->items->sum('kuantitas');
                                        @endphp
                                        @if($foto)
                                            <img src="{{ $foto && Str::startsWith($foto, 'products/') ? asset('storage/' . $foto) : asset($foto) }}" class="w-full h-full object-cover" alt="Product">
                                        @else
                                            <div class="w-full h-full bg-gray-100"></div>
                                        @endif
                                    </div>
                                    <!-- Item Count & Price Details -->
                                    <div>
                                        <p class="text-sm font-medium text-gray-600">
                                            {{ $totalItems }} items <span class="text-gray-300 mx-1.5">&bull;</span> {{ number_format($order->total_harga, 0, ',', '.') }} IDR
                                        </p>
                                    </div>
                                </div>
                                
                                @if($order->status_pesanan === 'shipped')
                                <!-- Action Button for Shipped Orders -->
                                <div class="flex justify-end mt-4">
                                    <form action="{{ route('user.orders.confirm-delivered', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold px-4 py-2.5 rounded-lg transition duration-150 ease-in-out cursor-pointer inline-block">
                                            Pesanan Telah Tiba
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                            @endforeach
                            
                            @if($historyOrders->count() > 2)
                                <div class="flex justify-center mt-4">
                                    <button type="button" 
                                            @click="expanded = !expanded" 
                                            class="text-xs font-semibold text-gray-500 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 border border-gray-200 px-4 py-2 rounded-xl transition cursor-pointer">
                                        <span x-show="!expanded">View More</span>
                                        <span x-show="expanded">View Less</span>
                                    </button>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

            </div>

        </div>

        <!-- Bottom Spacer -->
    <div style="height: 60px; width: 100%; display: block;"></div>
    
    <!-- Alpine.js logic for hiding orders -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('orderCard', (orderId) => ({
                hidden: false,
                async hideOrder() {
                    if (!confirm('Yakin ingin menghapus riwayat pesanan ini?')) return;
                    
                    try {
                        const response = await fetch(`/orders/${orderId}/hide`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });
                        
                        const data = await response.json();
                        if (data.success) {
                            this.hidden = true;
                        } else {
                            alert('Gagal menghapus pesanan.');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan pada server.');
                    }
                }
            }));
        });
    </script>
</x-app-layout>
