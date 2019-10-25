--- 公告API ---
Route::get('/announce', 'api\AnnounceController@annList');
Route::post('/announce', 'api\AnnounceController@newAnn');
Route::get('/announce/{announce}', 'api\AnnounceController@designAnn');
Route::put('/announce/{announce}', 'api\AnnounceController@updateAnn');
Route::delete('/announce/{announce}', 'api\AnnounceController@delAnn');

--- 會員API ---
Route::get('/member', 'api\MemberController@memberList');
Route::post('/member', 'api\MemberController@store');
Route::get('/member/{member}', 'api\MemberController@designUser');
Route::put('/member/{member}', 'api\MemberController@updatePassword');
Route::delete('/member/{member}', 'api\MemberController@delUser');

--- 金幣修改API ---
Route::put('/coin/{coin}', 'api\CoinController@updateCoin');

--- 交易記錄API ---
Route::get('/trans/{trans}', 'api\TransactionController@userTransList');

--- 停權/解除 API ---
Route::put('/ban/{ban}', 'api\StatusController@Ban');

--- 使用者登入記錄API ---
Route::get('/logs/{logs}', 'api\LogController@userLoginTime');