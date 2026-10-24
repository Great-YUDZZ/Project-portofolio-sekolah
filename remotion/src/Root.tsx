import React from 'react';
import { Composition } from 'remotion';
import { SkensaIntro } from './SkensaIntro';

export const RemotionRoot: React.FC = () => {
    return (
        <>
            <Composition
                id="SkensaIntro"
                component={SkensaIntro}
                durationInFrames={300}
                fps={60}
                width={1920}
                height={1080}
            />
        </>
    );
};
