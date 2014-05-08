<?php

class DatabaseSeeder extends Seeder {
  public function run() {
    Eloquent::unguard();
    
    $this->call('TableTruncater');
    $this->call('TableSeeder');
  }
}

class TableSeeder extends Seeder {
  public function run() {
    User::create([
      'email'        => 'dealer@carfinco.com',
      'password'     => Hash::make('password'),
      'account_type' => 'dealer',
      'account_id'   => Dealer::create([
        'number'     => 'dealer-number-00000',
        'name_first' => 'First',
        'name_last'  => 'Last',
        'phone'      => '1234567890'
      ])->id
    ]);
    
    User::create([
      'email'        => 'admin@carfinco.com',
      'password'     => Hash::make('password'),
      'account_type' => 'admin',
      'account_id'   => Admin::create([
        
      ])->id
    ]);
    
    User::create([
      'email'        => 'root@carfinco.com',
      'password'     => Hash::make('password'),
      'account_type' => 'root',
      'account_id'   => Root::create([
        
      ])->id
    ]);
  }
}

class TableTruncater extends Seeder {
  public function run() {
    $this->command->info('Getting foreign keys...');
    $t1 = microtime(true);
    
    // Get the database name
    $dbname = DB::connection('mysql')->getDatabaseName();    
    
    // Find the FKs
    $fks = DB::table('INFORMATION_SCHEMA.KEY_COLUMN_USAGE')
            ->select('TABLE_NAME', 'COLUMN_NAME', 'CONSTRAINT_NAME', 'REFERENCED_TABLE_NAME', 'REFERENCED_COLUMN_NAME')
      ->whereNotNull('REFERENCED_TABLE_NAME')
               ->get();
    
    // Find the tables
    $tables = DB::table('INFORMATION_SCHEMA.TABLES')
               ->select('TABLE_SCHEMA', 'TABLE_NAME')
                ->where('TABLE_SCHEMA', '=', $dbname)
                ->where('TABLE_NAME', '<>', 'migrations')
                  ->get();
    
    $this->command->info('Killing foreign keys...');
    
    // Kill all FKs
    foreach($fks as $fk) {
      Schema::table($fk->TABLE_NAME, function($table) use($fk) {
        $table->dropForeign($fk->CONSTRAINT_NAME);
      });
    }
    
    $this->command->info('Truncating tables...');
    
    // Truncate all tables
    foreach($tables as $table) {
      DB::table($table->TABLE_NAME)->truncate();
    }
    
    $this->command->info('Reinstating foreign keys...');
    
    // Add all the FKs back
    foreach($fks as $fk) {
      Schema::table($fk->TABLE_NAME, function($table) use($fk) {
        $table->foreign($fk->COLUMN_NAME)
              ->references($fk->REFERENCED_COLUMN_NAME)
              ->on($fk->REFERENCED_TABLE_NAME);
      });
    }
    
    $this->command->info('Truncation completed in ' . (microtime(true) - $t1) . ' seconds.');
  }
}