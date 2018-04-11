<?php
/**
 * Created by PhpStorm.
 * User: qxq
 * Date: 2018/3/21
 * Time: 21:43
 */

public class filterArr{
    public static void main( String args[]) {
        string list[] = ['aasdfas','asdfasdfas1','asdfasdfsd2','rew'];
        int nums[] = [0,1,2,3,4,5,6,7,8,9];
        for (int i = 0; i<list.length; i++) {
            if (list[i].length() > 5) {
                list[i].remove();
            }
            for (int j = 0; j<nums.length; j++) {
                if (list[i].indexof(nums[j])) {
                    list[i].remove();
                }
            }
        }
    }
}