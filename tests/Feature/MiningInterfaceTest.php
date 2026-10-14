<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\Request;
use Tests\TestCase;

class MiningInterfaceTest extends TestCase
{
    public function test_operational_navigation_links_to_login_for_guests(): void
    {
        $html = view('layouts.sidebar', ['empresa' => 'Unidad minera'])->render();

        $this->assertStringContainsString(route('loginIndex'), $html);
        $this->assertStringContainsString('Centro de control minero', $html);
        $this->assertStringContainsString('aria-current="page"', $html);
        $this->assertStringNotContainsString('mining-account', $html);
    }

    public function test_administration_navigation_highlights_the_current_module(): void
    {
        $route = app('router')->getRoutes()->match(Request::create('/equipos'));
        request()->setRouteResolver(fn () => $route);

        $html = view('layouts.sidebar_admin', ['empresa' => 'Unidad minera'])->render();

        $this->assertMatchesRegularExpression(
            '/class="nav-link active" href="'.preg_quote(route('equipos.index'), '/').'"\s+aria-current="page"/',
            $html
        );
        $this->assertSame(1, substr_count($html, 'aria-current="page"'));
        $this->assertStringContainsString('data-bs-target="#navbarVerticalCollapse"', $html);
        $this->assertStringContainsString(route('index'), $html);
    }

    public function test_authenticated_navigation_preserves_account_actions(): void
    {
        $this->actingAs(new User(['name' => 'Operador de mina']));

        $html = view('layouts.sidebar', ['empresa' => 'Unidad minera'])->render();

        $this->assertStringContainsString('Operador de mina', $html);
        $this->assertStringContainsString(route('admin.index'), $html);
        $this->assertStringContainsString(route('logout'), $html);
        $this->assertStringContainsString('data-bs-toggle="dropdown"', $html);
        $this->assertStringNotContainsString('>Ingresar ', $html);
    }

    public function test_administration_home_renders_all_management_modules(): void
    {
        $html = view('admin.index', ['empresa' => 'Unidad minera'])->render();

        foreach ([
            'equipos.index', 'barrenacion.index', 'molienda.index',
            'energia.index', 'pi.index', 'pl-people.index',
            'usuarios.index', 'ldap.index', 'molienda.configuracion',
        ] as $route) {
            $this->assertStringContainsString(route($route), $html);
        }

        $this->assertSame(9, substr_count($html, 'card mining-module'));
        $this->assertStringContainsString('mining-dashboard.css', $html);
        $this->assertStringContainsString('mining-dashboard.js', $html);
        $this->assertStringContainsString('lang="es"', $html);
    }
}
