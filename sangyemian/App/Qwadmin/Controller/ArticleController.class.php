<?php

namespace Qwadmin\Controller;
use Qwadmin\Controller\ComController;
use Vendor\Tree;

class ArticleController extends ComController {


	public function index(){
	    // $from = M("from");

                    $key=I('kw');     //获取到标题的输入值

                    $map['tels'] = array('like',"%".$key."%");     //赋值name=值 */

                                $count= M('from')->where($map)->count();// 查询满足要求的总记录数
                                $Page= new \Think\Page($count,30);// 实例化分页类 传入总记录数和每页显示的记录数
                                $show= $Page->show();// 分页显示输出

                                $result=D('from')->where($map)->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();

                                $this->assign('plan',$plan);
                                $this->assign('page',$show);
                                $this->assign('users',$result);
                                $this->assign('val',$key);

	    // $data = $from->select();

	    // // var_dump($data);
     //    $this->assign('data',$data);


		$this -> display();
	}

	public function del(){

		$aids = isset($_REQUEST['aids'])?$_REQUEST['aids']:false;
		if($aids){
			if(is_array($aids)){
				$aids = implode(',',$aids);
				$map['id']  = array('in',$aids);
			}else{
				$map = 'id='.$aids;
			}
			if(M('from')->where($map)->delete()){
				addlog('删除故事，AID：'.$aids);
				$this->success('恭喜，故事删除成功！');
			}else{
				$this->error('参数错误！');
			}
		}else{
			$this->error('参数错误！');
		}

	}

	public function edit($aid){

		$aid = intval($aid);
		$article = M('from')->where('id='.$aid)->find();
		if($article){

			$category = M('from')->field('id,names')->order('times asc')->select();
			$tree = new Tree($category);
			$str = "<option value=\$id \$selected>\$spacer\$name</option>"; //生成的形式
			$category = $tree->get_tree(0,$str,$article['sid']);
			$this->assign('category',$category);//导航

			$this->assign('article',$article);
		}else{
			$this->error('参数错误！');
		}
		$this -> display();
	}

	public function update($aid=0){

		$aid = intval($aid);
		$data['sid'] = isset($_POST['sid'])?intval($_POST['sid']):0;
		$data['names'] = isset($_POST['names'])?$_POST['names']:false;
		$data['tels'] = I('post.tels','','strip_tags');
		$data['imgs'] = I('post.imgs','','strip_tags');
		$data['texts'] = isset($_POST['texts'])?$_POST['texts']:false;
		$data['times'] = I('post.times','','strip_tags');
		$data['t'] = time();

		if($aid){
			M('from')->data($data)->where('id='.$aid)->save();
			addlog('编辑故事，AID：'.$aid);
			$this->success('恭喜！故事编辑成功！');
		}else{
			$aid = M('from')->data($data)->add();
			if($aid){
				addlog('新增故事，AID：'.$aid);
				$this->success('恭喜！故事新增成功！');
			}else{
				$this->error('抱歉，未知错误！');
			}

		}
	}



    // 导出exl
        public function look_down(){

            $m = M ('from');
            $data = $m->field('id,names,tels,imgs,texts,times')->order('times desc')->select();

            // 导出Exl
            import("Org.Util.PHPExcel");
            import("Org.Util.PHPExcel.Worksheet.Drawing");
            import("Org.Util.PHPExcel.Writer.Excel2007");
            $objPHPExcel = new \PHPExcel();

            $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);

            $objActSheet = $objPHPExcel->getActiveSheet();

            // 水平居中（位置很重要，建议在最初始位置）
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('A')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('B1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('C')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->setActiveSheetIndex(0)->getStyle('F')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objActSheet->setCellValue('A1', '用户编号');
            $objActSheet->setCellValue('B1', '姓名');
            $objActSheet->setCellValue('C1', '电话');
            $objActSheet->setCellValue('D1', '上传图片');
            $objActSheet->setCellValue('E1', '故事');
            $objActSheet->setCellValue('F1', '时间');
            // 设置个表格宽度
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(22);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(145);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(38);

            // 垂直居中
            $objPHPExcel->getActiveSheet()->getStyle('A')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

            foreach($data as $k=>$v){
                $k +=2;
                $objActSheet->setCellValue('A'.$k, $v['id']);
                $objActSheet->setCellValue('B'.$k, $v['names']);
                $objActSheet->setCellValue('C'.$k, $v['tels']);
                $img = M('from')->where('id = '.$v['id'])->field('imgs')->find();

                // 图片生成
                $objDrawing[$k] = new \PHPExcel_Worksheet_Drawing();
                $objDrawing[$k]->setPath('../sangeym/Public/Uploads/'.$img['imgs']);
                // 设置宽度高度
                $objDrawing[$k]->setHeight(50);//照片高度
                $objDrawing[$k]->setWidth(80); //照片宽度
                /*设置图片要插入的单元格*/
                $objDrawing[$k]->setCoordinates('D'.$k);
                // 图片偏移距离
                $objDrawing[$k]->setOffsetX(12);
                $objDrawing[$k]->setOffsetY(12);
                $objDrawing[$k]->setWorksheet($objPHPExcel->getActiveSheet());

                // 表格内容

                $objActSheet->setCellValue('E'.$k, $v['texts']);
                $objActSheet->setCellValue('F'.$k, $v['times']);

                // 表格高度
                $objActSheet->getRowDimension($k)->setRowHeight(70);

            }

            $fileName = '用户故事表';
            $date = date("Y-m-d",time());
            $fileName .= "_{$date}.xls";
            $fileName = iconv("utf-8", "gb2312", $fileName);
            //重命名表
            // $objPHPExcel->getActiveSheet()->setTitle('test');
            //设置活动单指数到第一个表,所以Excel打开这是第一个表
            $objPHPExcel->setActiveSheetIndex(0);
            header('Content-Type: application/vnd.ms-excel');
            header("Content-Disposition: attachment;filename=\"$fileName\"");
            header('Cache-Control: max-age=0');
            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output'); //文件通过浏览器下载
            // END
        }



}