<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class Authenticate {

	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;
	protected $roles;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
		$this->roles = \Config::get( 'auth.roles' );
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$required_permission = $this->getPermissions( $request );
		if ($this->auth->guest() or !$this->hasPermissions($required_permission))
		{
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->guest('map');
			}
		}

		return $next($request);
	}

	private function hasPermissions($permission) {
		return $this->auth->user()->permission >= $this->roles[ $permission ];
	}

	private function getPermissions(Request $request) {
		$actions = $request->route()->getAction();

		return $actions['permissions'];
	}
}
