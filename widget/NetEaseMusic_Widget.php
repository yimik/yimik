<?php
class NetEaseMusic_Widget extends WP_Widget {

    function NetEaseMusic_Widget(){
        $widget_ops = array('description' => '网易云音乐播放器');
        $control_ops = array('width' => 400, 'height' => 300);
        parent::WP_Widget(false,$name='网易云音乐播放器',$widget_ops,$control_ops);

        //parent::直接使用父类中的方法
        //$name 这个小工具的名称,
        //$widget_ops 可以给小工具进行描述等等。
        //$control_ops 可以对小工具进行简单的样式定义等等。
    }

    function form($instance) { // 给小工具(widget) 添加表单内容
        $link = esc_attr($instance['link']);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('link'); ?>">
                <textarea class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>"><?php echo $link?></textarea>
                <span>请将网易云音乐生成的外链地址拷贝在此处</span>
            </label>
        </p>
        <?php
    }
    function update($new_instance, $old_instance) { // 更新保存
        $pattern = "/\\swidth=\\S*\\s/i";
        $new_instance['link'] = preg_replace($pattern, " width=\"100%\" ", $new_instance['link']);
        return $new_instance;
    }
    function widget($args, $instance) { // 输出显示在页面上
        extract( $args );
        ?>
        <?php
            echo $before_widget;
            echo $instance['link'];
            echo $after_widget;
        ?>

        <?php
    }
}
?>