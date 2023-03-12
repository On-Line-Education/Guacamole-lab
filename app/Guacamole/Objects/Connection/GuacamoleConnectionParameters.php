<?php

namespace App\Guacamole\Objects\Connection;

class GuacamoleConnectionParameters
{
    public ?string $port;
    public ?string $read_only;
    public ?string $swap_red_blue;
    public ?string $cursor;
    public ?string $color_depth;
    public ?string $clipboard_encoding;
    public ?string $disable_copy;
    public ?string $disable_paste;
    public ?string $dest_port;
    public ?string $recording_exclude_output;
    public ?string $recording_exclude_mouse;
    public ?string $recording_include_keys;
    public ?string $create_recording_path;
    public ?string $enable_sftp;
    public ?string $sftp_port;
    public ?string $sftp_server_alive_interval;
    public ?string $enable_audio;
    public ?string $security;
    public ?string $disable_auth;
    public ?string $ignore_cert;
    public ?string $gateway_port;
    public ?string $server_layout;
    public ?string $timezone;
    public ?string $console;
    public ?string $width;
    public ?string $height;
    public ?string $dpi;
    public ?string $resize_method;
    public ?string $console_audio;
    public ?string $disable_audio;
    public ?string $enable_audio_input;
    public ?string $enable_printing;
    public ?string $enable_drive;
    public ?string $create_drive_path;
    public ?string $enable_wallpaper;
    public ?string $enable_theming;
    public ?string $enable_font_smoothing;
    public ?string $enable_full_window_drag;
    public ?string $enable_desktop_composition;
    public ?string $enable_menu_animations;
    public ?string $disable_bitmap_caching;
    public ?string $disable_offscreen_caching;
    public ?string $disable_glyph_caching;
    public ?string $preconnection_id;
    public ?string $hostname;
    public ?string $username;
    public ?string $password;
    public ?string $domain;
    public ?string $gateway_hostname;
    public ?string $gateway_username;
    public ?string $gateway_password;
    public ?string $gateway_domain;
    public ?string $initial_program;
    public ?string $client_name;
    public ?string $printer_name;
    public ?string $drive_name;
    public ?string $drive_path;
    public ?string $static_channels;
    public ?string $remote_app;
    public ?string $remote_app_dir;
    public ?string $remote_app_args;
    public ?string $preconnection_blob;
    public ?string $load_balance_info;
    public ?string $recording_path;
    public ?string $recording_name;
    public ?string $sftp_hostname;
    public ?string $sftp_host_key;
    public ?string $sftp_username;
    public ?string $sftp_password;
    public ?string $sftp_private_key;
    public ?string $sftp_passphrase;
    public ?string $sftp_root_directory;
    public ?string $sftp_directory;

    public function __construct(array $data)
    {
        $this->port = $data['port'] ?? '';
        $this->read_only = $data['read-only'] ?? '';
        $this->swap_red_blue = $data['swap-red-blue'] ?? '';
        $this->cursor = $data['cursor'] ?? '';
        $this->color_depth = $data['color-depth'] ?? '';
        $this->clipboard_encoding = $data['clipboard-encoding'] ?? '';
        $this->disable_copy = $data['disable-copy'] ?? '';
        $this->disable_paste = $data['disable-paste'] ?? '';
        $this->dest_port = $data['dest-port'] ?? '';
        $this->recording_exclude_output = $data['recording-exclude-output'] ?? '';
        $this->recording_exclude_mouse = $data['recording-exclude-mouse'] ?? '';
        $this->recording_include_keys = $data['recording-include-keys'] ?? '';
        $this->create_recording_path = $data['create-recording-path'] ?? '';
        $this->enable_sftp = $data['enable-sftp'] ?? '';
        $this->sftp_port = $data['sftp-port'] ?? '';
        $this->sftp_server_alive_interval = $data['sftp-server-alive-interval'] ?? '';
        $this->enable_audio = $data['enable-audio'] ?? '';
        $this->security = $data['security'] ?? '';
        $this->disable_auth = $data['disable-auth'] ?? '';
        $this->ignore_cert = $data['ignore-cert'] ?? '';
        $this->gateway_port = $data['gateway-port'] ?? '';
        $this->server_layout = $data['server-layout'] ?? '';
        $this->timezone = $data['timezone'] ?? '';
        $this->console = $data['console'] ?? '';
        $this->width = $data['width'] ?? '';
        $this->height = $data['height'] ?? '';
        $this->dpi = $data['dpi'] ?? '';
        $this->resize_method = $data['resize-method'] ?? '';
        $this->console_audio = $data['console-audio'] ?? '';
        $this->disable_audio = $data['disable-audio'] ?? '';
        $this->enable_audio_input = $data['enable-audio-input'] ?? '';
        $this->enable_printing = $data['enable-printing'] ?? '';
        $this->enable_drive = $data['enable-drive'] ?? '';
        $this->create_drive_path = $data['create-drive-path'] ?? '';
        $this->enable_wallpaper = $data['enable-wallpaper'] ?? '';
        $this->enable_theming = $data['enable-theming'] ?? '';
        $this->enable_font_smoothing = $data['enable-font-smoothing'] ?? '';
        $this->enable_full_window_drag = $data['enable-full-window-drag'] ?? '';
        $this->enable_desktop_composition = $data['enable-desktop-composition'] ?? '';
        $this->enable_menu_animations = $data['enable-menu-animations'] ?? '';
        $this->disable_bitmap_caching = $data['disable-bitmap-caching'] ?? '';
        $this->disable_offscreen_caching = $data['disable-offscreen-caching'] ?? '';
        $this->disable_glyph_caching = $data['disable-glyph-caching'] ?? '';
        $this->preconnection_id = $data['preconnection-id'] ?? '';
        $this->hostname = $data['hostname'] ?? '';
        $this->username = $data['username'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->domain = $data['domain'] ?? '';
        $this->gateway_hostname = $data['gateway-hostname'] ?? '';
        $this->gateway_username = $data['gateway-username'] ?? '';
        $this->gateway_password = $data['gateway-password'] ?? '';
        $this->gateway_domain = $data['gateway-domain'] ?? '';
        $this->initial_program = $data['initial-program'] ?? '';
        $this->client_name = $data['client-name'] ?? '';
        $this->printer_name = $data['printer-name'] ?? '';
        $this->drive_name = $data['drive-name'] ?? '';
        $this->drive_path = $data['drive-path'] ?? '';
        $this->static_channels = $data['static-channels'] ?? '';
        $this->remote_app = $data['remote-app'] ?? '';
        $this->remote_app_dir = $data['remote-app-dir'] ?? '';
        $this->remote_app_args = $data['remote-app-args'] ?? '';
        $this->preconnection_blob = $data['preconnection-blob'] ?? '';
        $this->load_balance_info = $data['load-balance-info'] ?? '';
        $this->recording_path = $data['recording-path'] ?? '';
        $this->recording_name = $data['recording-name'] ?? '';
        $this->sftp_hostname = $data['sftp-hostname'] ?? '';
        $this->sftp_host_key = $data['sftp-host-key'] ?? '';
        $this->sftp_username = $data['sftp-username'] ?? '';
        $this->sftp_password = $data['sftp-password'] ?? '';
        $this->sftp_private_key = $data['sftp-private-key'] ?? '';
        $this->sftp_passphrase = $data['sftp-passphrase'] ?? '';
        $this->sftp_root_directory = $data['sftp-root-directory'] ?? '';
        $this->sftp_directory = $data['sftp-directory'] ?? '';
    }

    public function getGuacFormat(): array
    {
        return [
            'port' => $this->port,
            'read-only' => $this->read_only,
            'swap-red-blue' => $this->swap_red_blue,
            'cursor' => $this->cursor,
            'color-depth' => $this->color_depth,
            'clipboard-encoding' => $this->clipboard_encoding,
            'disable-copy' => $this->disable_copy,
            'disable-paste' => $this->disable_paste,
            'dest-port' => $this->dest_port,
            'recording-exclude-output' => $this->recording_exclude_output,
            'recording-exclude-mouse' => $this->recording_exclude_mouse,
            'recording-include-keys' => $this->recording_include_keys,
            'create-recording-path' => $this->create_recording_path,
            'enable-sftp' => $this->enable_sftp,
            'sftp-port' => $this->sftp_port,
            'sftp-server-alive-interval' => $this->sftp_server_alive_interval,
            'enable-audio' => $this->enable_audio,
            'security' => $this->security,
            'disable-auth' => $this->disable_auth,
            'ignore-cert' => $this->ignore_cert,
            'gateway-port' => $this->gateway_port,
            'server-layout' => $this->server_layout,
            'timezone' => $this->timezone,
            'console' => $this->console,
            'width' => $this->width,
            'height' => $this->height,
            'dpi' => $this->dpi,
            'resize-method' => $this->resize_method,
            'console-audio' => $this->console_audio,
            'disable-audio' => $this->disable_audio,
            'enable-audio-input' => $this->enable_audio_input,
            'enable-printing' => $this->enable_printing,
            'enable-drive' => $this->enable_drive,
            'create-drive-path' => $this->create_drive_path,
            'enable-wallpaper' => $this->enable_wallpaper,
            'enable-theming' => $this->enable_theming,
            'enable-font-smoothing' => $this->enable_font_smoothing,
            'enable-full-window-drag' => $this->enable_full_window_drag,
            'enable-desktop-composition' => $this->enable_desktop_composition,
            'enable-menu-animations' => $this->enable_menu_animations,
            'disable-bitmap-caching' => $this->disable_bitmap_caching,
            'disable-offscreen-caching' => $this->disable_offscreen_caching,
            'disable-glyph-caching' => $this->disable_glyph_caching,
            'preconnection-id' => $this->preconnection_id,
            'hostname' => $this->hostname,
            'username' => $this->username,
            'password' => $this->password,
            'domain' => $this->domain,
            'gateway-hostname' => $this->gateway_hostname,
            'gateway-username' => $this->gateway_username,
            'gateway-password' => $this->gateway_password,
            'gateway-domain' => $this->gateway_domain,
            'initial-program' => $this->initial_program,
            'client-name' => $this->client_name,
            'printer-name' => $this->printer_name,
            'drive-name' => $this->drive_name,
            'drive-path' => $this->drive_path,
            'static-channels' => $this->static_channels,
            'remote-app' => $this->remote_app,
            'remote-app-dir' => $this->remote_app_dir,
            'remote-app-args' => $this->remote_app_args,
            'preconnection-blob' => $this->preconnection_blob,
            'load-balance-info' => $this->load_balance_info,
            'recording-path' => $this->recording_path,
            'recording-name' => $this->recording_name,
            'sftp-hostname' => $this->sftp_hostname,
            'sftp-host-key' => $this->sftp_host_key,
            'sftp-username' => $this->sftp_username,
            'sftp-password' => $this->sftp_password,
            'sftp-private-key' => $this->sftp_private_key,
            'sftp-passphrase' => $this->sftp_passphrase,
            'sftp-root-directory' => $this->sftp_root_directory,
            'sftp-directory' => $this->sftp_directory
        ];
    }
}
