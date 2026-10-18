<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Categories
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('category_id');
            $table->string('category_name');
            $table->string('category_image');
            $table->timestamps();
        });

        // 2. Products
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id');
            $table->unsignedInteger('category_id');
            $table->string('product_name');
            $table->integer('product_price');
            $table->string('product_image');
            $table->text('product_description');
            $table->boolean('product_status')->default(true);
            $table->timestamps();

            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
        });

        // 3. Sizes
        Schema::create('sizes', function (Blueprint $table) {
            $table->increments('size_id');
            $table->integer('size_value');
        });

        // 4. Product Sizes
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->increments('product_size_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('size_id');
            $table->integer('stock')->default(0);

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('size_id')->references('size_id')->on('sizes')->onDelete('cascade');
        });

        // 5. Billing Details
        Schema::create('billing_details', function (Blueprint $table) {
            $table->increments('billing_id');
            $table->unsignedInteger('user_id');
            $table->string('name');
            $table->string('phone_number');
            $table->text('address');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });

        // 6. Orders
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->unsignedInteger('billing_id')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping', 10, 2);
            $table->decimal('order_total', 10, 2);
            $table->decimal('payment', 10, 2);
            $table->timestamps();

            $table->foreign('billing_id')->references('billing_id')->on('billing_details')->onDelete('set null');
        });

        // 7. Order Items
        Schema::create('order_items', function (Blueprint $table) {
            $table->increments('item_id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('size_id');
            $table->decimal('product_price', 10, 2);
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('size_id')->references('size_id')->on('sizes')->onDelete('cascade');
        });

        // 8. Cart
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('cart_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('size_id');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('size_id')->references('size_id')->on('sizes')->onDelete('cascade');
        });

        // 9. Stock Requests
        Schema::create('stock_requests', function (Blueprint $table) {
            $table->increments('request_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('size_id');
            $table->integer('quantity');
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->timestamps();

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('size_id')->references('size_id')->on('sizes')->onDelete('cascade');
        });

        // 10. Supplier Transactions
        Schema::create('supplier_transactions', function (Blueprint $table) {
            $table->increments('transaction_id');
            $table->unsignedInteger('request_id')->nullable();
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('size_id');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->timestamps();

            $table->foreign('request_id')->references('request_id')->on('stock_requests')->onDelete('set null');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('size_id')->references('size_id')->on('sizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_transactions');
        Schema::dropIfExists('stock_requests');
        Schema::dropIfExists('cart');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('billing_details');
        Schema::dropIfExists('product_sizes');
        Schema::dropIfExists('sizes');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};
