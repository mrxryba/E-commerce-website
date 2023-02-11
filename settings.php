<?php
session_start();
include_once "./inc/autoloaderIndex.inc.php";
include_once "./inc/traitAutoloaderIndex.php";
include_once "./phpHeader.php";
include_once "./header.php";
$addressContr = new AddressContr();
$address = $addressContr->getAddress($user->getId());
$userContr = new UserContr();
?>
<div class="wrapper">
    <a class="wishlist-back-btn">Back</a>
    <h2 class="settings-heading">Account settings</h2>
    <div class="settings-navigation">
        This is nav
    </div>
    <div class="settings-account-details">
        <div class="settings-details">
            <h3 class="settings-details-heading">Your details</h3>
            <div class="settings-details-section">

                <p class="settings-details-section-name"><?php echo $user->getFirstName() . " " . $user->getLastName(); ?></p>
                <p class="settings-details-section-phone"><?php
                    echo ($user->getPhoneNumber()) ? $userContr->formatPhoneNumber($user->getPhoneNumber()) : "None";
                    ?></p>
                <button class="settings-details-section-edit-btn">Edit</button>

            </div>
            <h3 class="settings-email-heading">Email address</h3>
            <div class="settings-email-section">

                <p><?php echo $user->getEmail(); ?></p>
                <button class="settings-email-section-edit-btn">Change</button>
            </div>
            <h3 class="settings-pwd-heading">Password</h3>
            <div class="settings-pwd-section">

                <p>••••••••</p>
                <button class="settings-pwd-section-edit-btn">Change</button>
            </div>
        </div>
    </div>
    <div class="settings-remove-account-section">
        <h3>Account deletion</h3>
        <p>If you click on this button, you will delete your account in our store. Make sure you definitely want to do
            this - your account cannot be restored.</p>
        <a class="wishlist-back-btn">Remove account</a>
    </div>
</div>


<script src="inc/script.js"></script>
</body>
