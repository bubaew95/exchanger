import {useModal} from "../../Components/Hooks/useModal";
import {MyModal} from "../../Components/UI/MyModal/MyModal";
import ServerApi from "../../Server/ServerApi";
import {useState} from "react";
import {RequestData, RequestInterface} from "../../Server/RequestAdvertisementsInterface";
import {Button} from "react-bootstrap";
import List from "../../Components/List/List";

import Swal from 'sweetalert2'

const api = new ServerApi();

export const Actions = {
    DELETE: 'delete',
    ADD: 'add'
}

export default function ({advertisementId}: {advertisementId: number}) {
    const { isOpen, openModal, closeModal } = useModal();
    const [isEdit, setIsEdit] = useState<boolean>(false);

    const [request, setRequest] = useState<RequestInterface>({
        error: null,
        isLoading: true,
        data: []
    });

    const getMyAdvertisements = async() => {
        setRequest((prevRequest) => ({...prevRequest, isLoading: true}));
        try {
            const request: RequestData[] = await api.myAdvertisements(advertisementId);
            setRequest((prevRequest) => ({...prevRequest, data: request}));
        } catch (error: any) {
            setRequest((prevRequest) => ({...prevRequest, error: error.message }));
        } finally {
            setRequest((prevRequest) => ({...prevRequest, isLoading: false}));
        }
    }

    const onRequestAdvertisements = () => {
        getMyAdvertisements();
        openModal();
    }

    const isProposed = (id: number, flag: boolean) => {
        const newData = request.data.map((item: RequestData) => {
            return item.id === id ? {...item, isProposed: flag} : item;
        });
        setRequest((prevRequest) => ({...prevRequest, data: newData}));
    }

    const onSelect = async (proposeId: number, action: string = Actions.ADD) => {
        if(action === Actions.ADD) {
            await Swal.fire({
                title: "Вы согласны отправить предложение по обмену?",
                text: "Если Вы не согласны нажмите на кнопку Отменить.",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Да",
                cancelButtonText: "Закрыть"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const {id} = await api.addOffer(advertisementId, proposeId);
                    isProposed(id, true);
                    setIsEdit(true);
                }
            });
        }

        if(action === Actions.DELETE) {
            await Swal.fire({
                title: "Вы уверене что хотите отказаться от обмена?",
                text: "Если Вы не согласны нажмите на кнопку Отменить.",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#d33",
                confirmButtonText: "Да",
                cancelButtonText: "Закрыть"
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const {id} = await api.deleteOffer(advertisementId, proposeId);
                    isProposed(id, false);
                    setIsEdit(true);
                }
            });
        }
    }

    const onCloseModal = () => {
        closeModal();

        if(isEdit) {
            window.location.reload();
        }
    }

    return (
        <>
            <Button className="btn btn-success text-white" onClick={onRequestAdvertisements} tabIndex={0}>
                <i className="fa fa-plus-square mr-2" aria-hidden="true"></i>
                Предложить обмен
            </Button>

            <MyModal isOpen={isOpen} closeModal={onCloseModal}>
                {request.isLoading && <p>Loading...</p>}
                {!request.isLoading && request.error && <p>{request.error}</p>}
                {
                    request.data && <List onClick={onSelect} items={request.data} />
                }
            </MyModal>
        </>
    );
}
