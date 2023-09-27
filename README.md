# Bin It!
![images/classic_nes_controller](/binit-logo.png)

Bin it (binit) contains a discretization algorithm coded in PHP and Laravel Zero.
It is essentially a binning tool used to perform one of two actions:

1) The bins are of **equal width**
    *ie) These intervals are of equal width: (0,10], (10, 20], (20, 30]*
2) The bins are of **equal frequency**
    *ie) When fed this array [1, 2, 3, 4, 5, 6, 7, 8], the output for **TWO** bins would be:*
        [1, 2, 3, 4] (*First Bin*)
        [5, 6, 7, 8] (*Second Bin*)

## Intructions:
*Note:* You **MUST** have **Laravel Zero** and **PHP @8.1** or greater already installed in order to run this CLI application.

**1.** Clone the repository or simply download a ZIP (via green "Code <>" button -> **Download Zip**).
*2A.* Extract the compressed directory anywhere on your device (if you downloaded the zip).
**3.** If cloned, navigate to the directory via cmder/command prompt or terminal.
**4.** Type **./binit discretize** *--algorithm --array* (floats or ints)
    *ex) ./binit discretize equal-width 0.5 1.2 2.3 3.4 4.5 5.6 6.7 6.6 7.8 8.9*
**5.** Watch the magic happen!

## Final Note:
To see a full list of available instructions type **./binit** from the main directory.
Happy binning!
