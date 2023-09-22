<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Permission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CommunityController extends Controller
{
    private const PAGINATE = 6;

    // default avatar
    private $avatar;

    // years
    private array $years;

    // cities
    private Collection $offices;

    // team los
    private Collection $team_los;

    // team sublos
    private Collection $team_sublos;

    public function __construct()
    {
        $this->avatar = url(Config::get('constants.alumni.avatar'));
        $this->years = range(now()->year, 1981, -1);
        $this->offices = DB::table('pwc_offices')->get();
        $this->team_los = DB::table('pwc_los')->get();
        $this->team_sublos = DB::table('pwc_sublos')->get();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        // get users
        $users = $this->getUsers();

        return response()->view('alumni.community.index', [
            'users' => $users->paginate(self::PAGINATE),
            'avatar' => $this->avatar,
            'years' => $this->years,
            'pwc_offices' => $this->offices,
            'team_los' => $this->team_los,
            'team_sublos' => $this->team_sublos,
        ]);
    }

    /**
     * Filter alumni users
     *
     * @return Response|RedirectResponse
     *
     * @throws ValidationException
     */
    public function filter(Request $request): Response
    {
        // get only intended fields
        $inputs = $request->only([
            'order',
            'first_name',
            'surname',
            'pwc_worked_team_los',
            'pwc_worked_team_sublos',
            'pwc_worked_office',
            'pwc_join_year',
            'pwc_quit_year',
        ]);
        $validator = Validator::make($inputs, $this->rules(), [], $this->attributes());

        // if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        // get clean data
        $data = $validator->validated();

        // merge name and surname
        $first_name = $data['first_name'] ?? '';
        $surname = $data['surname'] ?? '';
        $name = sprintf('%s %s', $first_name, $surname);
        $name = trim($name);

        $query = $this->getUsers();
        // filter by name
        if (strlen($name) > 1) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        // filter by worked team
        if (isset($data['pwc_worked_team_los'])) {
            $query->where('pwc_worked_team_los', $data['pwc_worked_team_los']);
        }

        // filter by worked team
        if (isset($data['pwc_worked_team_sublos'])) {
            $query->where('pwc_worked_team_sublos', 'like', '%' . $data['pwc_worked_team_sublos'] . '%');
        }

        // filter by worked office
        if (isset($data['pwc_worked_office'])) {
            $query->where('pwc_worked_office', $data['pwc_worked_office']);
        }

        // filter by join year
        if (isset($data['pwc_join_year'])) {
            $query->whereYear('pwc_join_year', $data['pwc_join_year']);
        }

        // filter by quit year
        if (isset($data['pwc_quit_year'])) {
            $query->whereYear('pwc_quit_year', $data['pwc_quit_year']);
        }

        // order by
        if (isset($data['order'])) {
            switch ($data['order']) {
                case 1:
                    $query = $query->orderBy('name');
                    break;
                case 2:
                    $query = $query->orderBy('created_at', 'ASC');
                    break;
                case 3:
                    $query = $query->orderBy('created_at', 'DESC');
                    break;
            }
        }

        // get filtered users
        $users = $query->paginate(self::PAGINATE);

        return response()->view('alumni.community.index', [
            'users' => $users,
            'avatar' => $this->avatar,
            'years' => $this->years,
            'posted' => $data,
            'name' => $first_name,
            'surname' => $surname,
            'pwc_offices' => $this->offices,
            'team_los' => $this->team_los,
            'team_sublos' => $this->team_sublos,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'order' => 'nullable|integer',
            'first_name' => 'nullable|string',
            'surname' => 'nullable|string',
            'pwc_worked_team_los' => 'nullable|string',
            'pwc_worked_team_sublos' => 'nullable|string',
            'pwc_worked_office' => 'nullable|string',
            'pwc_join_year' => 'nullable|integer',
            'pwc_quit_year' => 'nullable|integer',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'order' => 'Sıralama',
            'first_name' => 'Ad',
            'surname' => 'Soyad',
            'pwc_worked_team_los' => 'Çalıştığı Birim Los',
            'pwc_worked_team_sublos' => 'Çalıştığı Birim SubLos',
            'pwc_worked_office' => 'Çalıştığı Ofis',
            'pwc_join_year' => 'Giriş Yılı',
            'pwc_quit_year' => 'Çıkış Yılı',
        ];
    }

    private function getUsers()
    {
        return Permission::with(['users'])
            ->where('slug', 'directory')
            ->firstOrFail()
            ->users()
            ->where('users.id', '!=', auth()->id());
    }
}
