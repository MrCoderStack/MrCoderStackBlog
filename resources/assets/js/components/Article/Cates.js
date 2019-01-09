import React, { Component } from 'react';
import { Breadcrumb, Icon, Table, Button, Tooltip, Modal, message, Form, Input, Radio } from 'antd';
const ButtonGroup = Button.Group;
const confirm = Modal.confirm;
const CollectionCreateForm = Form.create()(
    class extends React.Component {
        render() {
            const {
                visible, onCancel, onCreate, form,
            } = this.props;
            const { getFieldDecorator } = form;
            return (
                <Modal
                visible={visible}
                title="新增分类"
                okText="提交"
                onCancel={onCancel}
                onOk={onCreate}
                    >
                    <Form layout="vertical">
                        <Form.Item label="分类名称">
                            {getFieldDecorator('cate_name', {
                                    rules: [{ required: true, message: '请输入分类名称!' }],
                                })(
                                <Input />
                            )}
                        </Form.Item>
                    </Form>
                </Modal>
        );
        }
    }
);

import { Link } from 'react-router-dom';
export class Cates extends React.Component {

    state = {
        visible: false,
    };

    showModal = () => {
    this.setState({ visible: true });
}

handleCancel = () => {
    this.setState({ visible: false });
}

handleCreate = () => {
    const form = this.formRef.props.form;
    form.validateFields((err, values) => {
        if (err) {
            return;
        }
        axios.post(window.apiURL + 'cates', values)
        .then((response) => {
            if(response.data.code == '200'){
            message.success(response.data.message);
            location.reload();}else{
                message.error(response.data.message);
            }
        })
        .catch((error) => {
            console.log(error);
            message.error('error');
        });
    form.resetFields();
    this.setState({ visible: false });
});
}

saveFormRef = (formRef) => {
    this.formRef = formRef;
}

constructor() {
    super();
    this.state = {
      //表格数据
      cates:[],
      loading:true,
    };
  }
  componentWillMount() {
    this.fetchData()
  }
  render (){
    //表格行配置
    const columns = [{
      title: 'ID',
      dataIndex: 'id',
      key: 'id',
      width: 50,
    },{
      title: '分类名称',
      dataIndex: 'name',
      key: 'name',
    },{
      title: '文章数',
      dataIndex: 'article_num',
      key: 'article_num',
    },{
      title: '搜索热度',
      dataIndex: 'search_num',
      key: 'search_num',
    },{
      title: '操作',
      key: 'action',
      width: 150,
      render: (text, record) => (
        <span>
          <ButtonGroup>
            <Tooltip title="删除">
              <Button icon="delete" onClick={this.handleDelete.bind(this, record.id)}/>
            </Tooltip>
          </ButtonGroup>
        </span>
      ),
    },];
    return (
      <div style={{padding:20}}>
        <Breadcrumb style={{ marginBottom:20 }}>
          <Breadcrumb.Item>
            <Link to="/articles">
            <Icon type="home" />
            <span> 文章管理</span>
            </Link>
          </Breadcrumb.Item>
          <Breadcrumb.Item>
            分类管理
          </Breadcrumb.Item>

        </Breadcrumb>
          <div style={{ marginBottom:80 }}><Button type="primary" icon="edit" style={{float: 'right'}} onClick={this.showModal}>新增分类</Button>
            <CollectionCreateForm
            wrappedComponentRef={this.saveFormRef}
            visible={this.state.visible}
            onCancel={this.handleCancel}
            onCreate={this.handleCreate}
            />
            </div>
        <Table
          size="small"
          bordered
          dataSource={this.state.cates}
          loading={this.state.loading}
          columns={columns}
          pagination={{
            showSizeChanger:true,
            showQuickJumper:true
          }}/>
      </div>
    )
  }
  //获取数据
  fetchData(){
    this.setState({ loading:true });
    axios.get(window.apiURL + 'cates')
    .then((response) => {
      this.setState({
        cates:response.data.cates,
        loading:false,
      })
    })
    .catch((error) => {
      console.log(error);
    });
  }
  //删除分类
  handleDelete = (id) =>{
    confirm({
      title: '确认删除',
      content: '此操作将会永久删除此分类，确认继续？',
      okText: 'Yes',
      okType: 'danger',
      cancelText: 'No',
      onOk:() => {
        axios.get(window.apiURL + 'cates/delete/' + id)
        .then((response) => {
          if (response.status == 200) {
            this.fetchData()
            message.success(response.data.message)
          }
        })
        .catch((error) => {
          console.log(error);
        });
      },
      onCancel:() => {
        console.log('取消删除');
      },
    });
  }
}
