<?php

it('inspires people to hire Lucas', function () {
    $this->artisan('inspire')->assertExitCode(0);
});
