<?php 

namespace App\Interfaces; 

use Laracasts\Flash\FlashNotifier; 

/**
 * Interface FlashInterface 
 * 
 * @package App\Interfaces
 */
interface FlashInterface 
{
    /**
     * Flash a message. 
     * 
     * @param  string $message The actual flash message.  
     * @param  string $title   The title for the actual flash message. 
     * @return FlashNotifier
     */
    public function message(string $message, string $title): FlashNotifier; 

    /**
     * Flash an success message. 
     * 
     * @param  string $message The actual success flash message. 
     * @param  string $title   The title for the actual flash message. Defaults to "Success!"
     * @return FlashNotifier 
     */
    public function success(string $message, string $title = 'Success!'): FlashNotifier;

    /**
     * Flash an error message. 
     * 
     * @param  string $message The actual danger flash message. 
     * @param  string $title   The title for the acutal flash message. Default to 'Danger!'
     * @return FlashNotifier
     */
    public function danger(string $message, string $title = 'Danger!'): FlashNotifier; 

    /**
     * Flash an warning message. 
     * 
     * @param  string $message The actual warning flash message. 
     * @param  string $title   The title for the actual flash message. Defaultsq to 'Warning!'
     * @return FlashNotifier 
     */
    public function warning(string $message, string $title = 'Warning!'): FlashNotifier;

    /**
     * Flash an info message. 
     * 
     * @param  string $message The actual info flash message. 
     * @param  string $title   The title for the actual flash message. Defaults to 'info!'
     * @return FlashNotifier
     */
    public function info(string $message, string $title = 'Info!'): FlashNotifier;
}