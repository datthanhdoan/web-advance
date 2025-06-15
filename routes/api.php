// Trong routes/api.php hoặc routes/web.php nếu bạn muốn dùng form submit
use App\Http\Controllers\ClapController;

Route::post('/posts/{post}/clap', [ClapController::class, 'toggleClap'])
->middleware('auth');
